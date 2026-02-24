<?php

namespace App\Http\Controllers;
use App\Models\Expense;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class ExpenseController extends Controller
{
    public function store(Request $request){
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'amount' => ['required', 'numeric', 'min:0'],
            'date' => ['required', 'date'],
            'category_id' => ['required'],
            'colocation_id' => ['required']
        ]);

        $user = Auth::user();

        $expense = Expense::create([
            'titre' => $request->name,
            'amount' => $request->amount,
            'date' => $request->date,
            'category_id' => $request->category_id,
            'colocation_id' => $request->colocation_id,
            'user_id' => $user->id
        ]);

        return back()->with('success', 'expense created');
    }
}
