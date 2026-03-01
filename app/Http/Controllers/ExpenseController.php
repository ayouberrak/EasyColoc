<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use App\Models\Credit;
use App\Models\Colocation;
use App\Models\ColocationMember;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ExpenseController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'amount' => 'required|numeric|min:0',
            'date' => 'required|date',
            'category_id' => 'required',
            'colocation_id' => 'required',
        ]);

        $user = Auth::user();

        Expense::create([
            'titre' => $request->name,
            'amount' => $request->amount,
            'date' => $request->date,
            'category_id' => $request->category_id,
            'colocation_id' => $request->colocation_id,
            'user_id' => $user->id,
        ]);

        $colocation = Colocation::findOrFail($request->colocation_id);

        $members = ColocationMember::where('colocation_id', $colocation->id)
            ->whereNull('left_at')
            ->pluck('user_id')
            ->toArray();

        if (!in_array($colocation->user_id, $members)) {
            $members[] = $colocation->user_id;
        }

        $count = count($members);
        if ($count <= 1) {
            return back()->with('success', 'depense enregistre');
        }

        $part = $request->amount / $count;

        foreach ($members as $memberId) {
            if ($memberId == $user->id) continue;

            $reverse = Credit::where('colocation_id', $colocation->id)
                ->where('debtor_id', $user->id)
                ->where('creditor_id', $memberId)
                ->first();

            if ($reverse) {
                if ($reverse->amount >= $part) {
                    $reverse->amount -= $part;
                    $reverse->save();
                } else {
                    $reste = $part - $reverse->amount;
                    $reverse->delete();

                    if ($reste > 0) {
                        $debt = Credit::where('colocation_id', $colocation->id)
                            ->where('debtor_id', $memberId)
                            ->where('creditor_id', $user->id)
                            ->first();

                        if ($debt) {
                            $debt->amount += $reste;
                            $debt->save();
                        } else {
                            Credit::create([
                                'colocation_id' => $colocation->id,
                                'debtor_id' => $memberId,
                                'creditor_id' => $user->id,
                                'amount' => $reste,
                            ]);
                        }
                    }
                }
            } else {
                $debt = Credit::where('colocation_id', $colocation->id)
                    ->where('debtor_id', $memberId)
                    ->where('creditor_id', $user->id)
                    ->first();

                if ($debt) {
                    $debt->amount += $part;
                    $debt->save();
                } else {
                    Credit::create([
                        'colocation_id' => $colocation->id,
                        'debtor_id' => $memberId,
                        'creditor_id' => $user->id,
                        'amount' => $part,
                    ]);
                }
            }
        }

        return back()->with('success', 'depense enregistre');
    }
}