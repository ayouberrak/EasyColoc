<?php

namespace App\Http\Controllers;

use App\Models\Colocation;
use App\Models\ColocationMember;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MemberDashboardController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();
        $activeMember = ColocationMember::where('user_id', $user->id)
            ->whereNull('left_at')
            ->first();

        if (!$activeMember) {
            return redirect()->route('colocations.create');
        }

        $colocation = $activeMember->colocation;
        $tab = $request->get('tab', 'dashboard');

        return view('colocations.member', compact('colocation', 'tab'));
    }
}
