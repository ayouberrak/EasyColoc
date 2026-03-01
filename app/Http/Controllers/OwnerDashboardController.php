<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Colocation;
use App\Models\ColocationMember;
use App\Models\Credit;
use App\Models\Invitation;
use App\Models\Expense;
use App\Models\Payment;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class OwnerDashboardController extends Controller
{
    public function index(Request $request): View
    {
        $user = Auth::user();
        $colocation = $this->getColocation($user, $request->colocation_id);

        if (!$colocation) {
            return redirect()->route('home');
        }

        $tab = $this->getTab($request->tab);

        $members = $this->getMembersWithOwner($colocation);

        $potentialMembers = $this->getPotentialMembers($user, $members, $request->search);

        $pendingInvitations = $this->getPendingInvitations($colocation->id);

        $expenses = $this->getExpenses($colocation->id, $request->month, $request->year);

        $payments = $this->getPayments($colocation->id);

        $totalExp = $expenses->sum('amount');
        $totalPay = $payments->sum('amount');
        $balance = $totalPay - $totalExp;

        $categories = Category::where('colocation_id', $colocation->id)
            ->orWhereNull('colocation_id')
            ->get();
            
        $debts = Credit::with(['debtor','creditor'])
            ->where('colocation_id', $colocation->id)
            ->get();

        return view('colocations.owner', [
            'colocation' => $colocation,
            'tab' => $tab,
            'potentialMembers' => $potentialMembers,
            'search' => $request->search,
            'pendingInvitations' => $pendingInvitations,
            'activeMembers' => $members,
            'balance' => $balance,
            'totalExp' => $totalExp,
            'totalPay' => $totalPay,
            'payments' => $payments,
            'categories' => $categories,
            'debts' => $debts,
        ]);
    }

    private function getColocation($user, $requestedColocationId = null)
    {
        if ($user->is_global_admin && $requestedColocationId) {
            return Colocation::find($requestedColocationId);
        }

        return Colocation::where('user_id', $user->id)->first();
    }

    private function getTab($tab): string
    {
        return in_array($tab, ['dashboard','members','expenses','payments', 'categories', 'chat']) ? $tab : 'dashboard';
    }

    private function getMembersWithOwner(Colocation $colocation)
    {
        $members = $colocation->members;

        if (!$members->contains('user_id', $colocation->user_id)) {
            $ownerMember = new ColocationMember([
                'user_id' => $colocation->user_id,
                'colocation_id' => $colocation->id,
                'role' => 'owner',
                'created_at' => $colocation->created_at ?? now()
            ]);
            $ownerMember->setRelation('user', $colocation->owner);
            $members->push($ownerMember);
        }

        return $members;
    }

    private function getPotentialMembers($user, $members, $search)
    {
        $memberIds = $members->pluck('user_id')->toArray();
        $query = User::whereNotIn('id', array_merge([$user->id], $memberIds));

        if ($search) {
            $query->where('name', 'like', '%' . $search . '%');
        }

        return $query->get();
    }

    private function getPendingInvitations($colocationId)
    {
        return Invitation::where('colocation_id', $colocationId)
            ->where('status', 'pending')
            ->get();
    }

    private function getExpenses($colocationId, $month = null, $year = null)
    {
        $query = Expense::where('colocation_id', $colocationId);

        if ($month) {
            $query = $query->whereMonth('date', $month);
        }
        if ($year) {
            $query = $query->whereYear('date', $year);
        }
        return $query->get();
    }

    private function getPayments($colocationId)
    {
        return Payment::with(['user','expense'])
            ->where('colocation_id', $colocationId)
            ->orderByDesc('created_at')
            ->get();
    }


    public function anullerColocation(Request $request)
    {
        $user = Auth::user();
        $colocation = Colocation::where('user_id', $user->id)->firstOrFail();

        $colocation->update(['status' => 'cancelled']);
        $colocation->members()->update(['left_at' => now()]);

        return redirect()->route('home')->with('success', 'La colocation a été annulée avec succès.');
    }
}