<?php

namespace App\Http\Controllers;

use App\Models\Colocation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Invitation;
use App\Models\Expense;
use App\Models\Payment;

class OwnerDashboardController extends Controller
{
public function index(Request $request)
{
    $user = Auth::user();
    $colocation = Colocation::where('user_id', $user->id)->first();

    if (!$colocation) {
        return redirect()->route('colocations.create');
    }

    $tab = $request->tab ?? 'dashboard';

    $lien = ['dashboard', 'members', 'expenses', 'payments'];

    if (!in_array($tab, $lien)) {
        $tab = 'dashboard';
    }

    $search = $request->search;

    
    $query = User::where('id', '!=', $user->id);

    if ($search) {
        $query->where('name', 'like', '%' . $search . '%');
    }

    $num = $query->get();

    $pendingInvitations = Invitation::where('colocation_id', $colocation->id)
        ->where('status', 'pending')
        ->get();

    $expenses = Expense::where('colocation_id', $colocation->id)->get();
    $payments = Payment::with(['user', 'expense'])->where('colocation_id', $colocation->id)->orderBy('created_at', 'desc')->get();

    $totalExp = $expenses->sum('amount');
    $totalPay = $payments->sum('amount');

    $balance = $totalPay - $totalExp;
    

    $categories = \App\Models\Category::all();
    $debts = \App\Models\Credit::with(['debtor', 'creditor'])->where('colocation_id', $colocation->id)->get();


    return view('colocations.owner', [
        'colocation' => $colocation,
        'tab' => $tab,
        'potentialMembers' => $num,
        'search' => $search,
        'pendingInvitations' => $pendingInvitations,
        'balance' => $balance,
        'totalExp' => $totalExp,
        'totalPay' => $totalPay,
        'payments' => $payments,
        'categories' => $categories,
        'debts' => $debts
    ]);
}
}
