<?php

namespace App\Http\Controllers;
use App\Models\Expense;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;
use App\Models\Credit;
use App\Models\Colocation;

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

        $colocation = Colocation::with('members')->findOrFail($request->colocation_id);
        $members = $colocation->members;
        $memberCount = $members->count();

        if ($memberCount > 1) {
            $share = $request->amount / $memberCount;

            foreach ($members as $member) {
                if ($member->user_id == $user->id) continue;

                $reverseDebt = Credit::where('colocation_id', $colocation->id)
                    ->where('debtor_id', $user->id)       
                    ->where('creditor_id', $member->user_id)
                    ->first();

                if ($reverseDebt) {
                    if ($reverseDebt->amount > $share) {
                        $reverseDebt->decrement('amount', $share);
                    } else {
                        $remaining = $share - $reverseDebt->amount;
                        $reverseDebt->delete();
                        if ($remaining > 0) {
                            Credit::create([
                                'colocation_id' => $colocation->id,
                                'debtor_id' => $member->user_id,
                                'creditor_id' => $user->id,
                                'amount' => $remaining
                            ]);
                        }
                    }
                } else {
                    $debt = Credit::firstOrCreate(
                        ['colocation_id' => $colocation->id, 'debtor_id' => $member->user_id, 'creditor_id' => $user->id],
                        ['amount' => 0]
                    );
                    $debt->increment('amount', $share);
                }
            }
        }

        return back()->with('success', 'Dépense enregistrée et partagée !');
    }
}
