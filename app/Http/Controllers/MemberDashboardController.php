<?php

namespace App\Http\Controllers;

use App\Models\Colocation;
use App\Models\ColocationMember;
use App\Models\Credit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Category;
use Carbon\Carbon;
use League\CommonMark\Extension\CommonMark\Parser\Inline\EscapableParser;


class MemberDashboardController extends Controller
{

    public function index(Request $request)
    {
        $user = Auth::user();

        $activeMemberships = ColocationMember::where('user_id', $user->id)
            ->whereNull('left_at')
            ->get();

        if (!$activeMemberships) {
            return redirect()->route('home');
        }

        $member = $this->getSelectedMember($user, $activeMemberships, $request->colocation_id);

        if (!$member) {
            return redirect()->route('home');
        }

        $colocation = $member->colocation;
        $tab = $this->getTab($request->tab, ['dashboard', 'members', 'expenses', 'chat']);

        $categories = $this->getAllCategories($colocation->id);
        $debts = $this->getDebts($colocation->id);

        $members = $this->getMembersWithOwner($colocation);

        $expenses = $this->getExpenses($colocation, $request->month, $request->year);

        $userDebts = [];
        if ($tab === 'payments') {
            $userDebts = Credit::with('creditor')
                ->where('colocation_id', $colocation->id)
                ->where('debtor_id', $user->id)
                ->get();
        }

        return view('colocations.member', compact(
            'colocation', 'tab', 'categories', 'debts', 'expenses', 'activeMemberships', 'userDebts'
        ));
    }

    private function getSelectedMember($user, $activeMemberships, $requestedColocationId)
    {
        if ($user->is_global_admin && $requestedColocationId) {
            return $activeMemberships->firstWhere('colocation_id', $requestedColocationId);
        }

        return $activeMemberships->first();
    }

    private function getTab($tab, $allowedTabs)
    {
        $allTabs = array_merge($allowedTabs, ['payments']);
        return in_array($tab, $allTabs) ? $tab : 'dashboard';
    }

    private function getAllCategories($colocationId)
    {
        return Category::where('colocation_id', $colocationId)
            ->orWhereNull('colocation_id')
            ->get();
    }


    private function getDebts($colocationId)
    {
        return Credit::with(['debtor','creditor'])
            ->where('colocation_id', $colocationId)
            ->get();
    }

    private function getMembersWithOwner($colocation)
    {
        $members = $colocation->members;

        if (!$members->contains('user_id', $colocation->user_id)) {
            $owner = new ColocationMember([
                'user_id' => $colocation->user_id,
                'colocation_id' => $colocation->id,
                'role' => 'owner',
                'reputation' => 0,
                'created_at' => $colocation->created_at ?? now()
            ]);
            $owner->setRelation('user', $colocation->owner);
            $members->push($owner);
        }

        $colocation->setRelation('members', $members);

        return $members;
    }

    private function getExpenses($colocation, $month = null, $year = null)
    {
        $query = $colocation->expenses()->with('payer');

        if ($month){
            $query->whereMonth('date', $month);
        } 
        if ($year){
            $query->whereYear('date', $year);
        } 

        return $query->orderBy('date','desc')->get();
    }


    public function leaveSeul(Request $request)
    {
        $userId = Auth::id();

        $member = ColocationMember::where('user_id', $userId)->firstOrFail();

        $hasCredit = Credit::where('creditor_id', $userId)->exists();

        $member->update([
            'left_at' => Carbon::now(),
            'reputation' => $member->reputation + ($hasCredit ? -1 : 1)
        ]);

        return redirect()->route('home');
    }


public function leaveByOwner(ColocationMember $member)
{
    $ownerId = $member->colocation->user_id;
    $colocationId = $member->colocation_id;
    $leavingUserId = $member->user_id;

    Credit::where('colocation_id', $colocationId)
        ->where('creditor_id', $leavingUserId)
        ->update(['creditor_id' => $ownerId]);

    Credit::where('colocation_id', $colocationId)
        ->where('debtor_id', $leavingUserId)
        ->update(['debtor_id' => $ownerId]);

    $member->update([
        'left_at' => Carbon::now()
    ]);

    if (Credit::where('colocation_id', $colocationId)
            ->where('debtor_id', $leavingUserId)
            ->exists()
    ) {
        $member->decrement('reputation');
    } else {
        $member->increment('reputation');
    }

    Credit::where('colocation_id', $colocationId)
        ->where('creditor_id', $ownerId)
        ->where('debtor_id', $ownerId)
        ->delete();

    $duplicatePairs = Credit::where('colocation_id', $colocationId)
        ->select('debtor_id', 'creditor_id')
        ->groupBy('debtor_id', 'creditor_id')
        ->havingRaw('COUNT(*) > 1')
        ->get();

    foreach ($duplicatePairs as $pair) {
        $totalAmount = Credit::where('colocation_id', $colocationId)
            ->where('debtor_id', $pair->debtor_id)
            ->where('creditor_id', $pair->creditor_id)
            ->sum('amount');

        $credits = Credit::where('colocation_id', $colocationId)
            ->where('debtor_id', $pair->debtor_id)
            ->where('creditor_id', $pair->creditor_id)
            ->get();

        $first = $credits->shift();
        $first->update(['amount' => $totalAmount]);

        foreach ($credits as $duplicate) {
            $duplicate->delete();
        }
    }

    return redirect()->route('dashboard');
}

}
