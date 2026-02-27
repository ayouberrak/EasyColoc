<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Payment;
use App\Models\Credit;

class PaymentController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'credit_id' => 'required|exists:credits,id',
        ]);

        $credit = Credit::findOrFail($request->credit_id);

        Payment::create([
            'colocation_id' => $credit->colocation_id,
            'payer_id' => $credit->debtor_id,
            'credit' => $request->credit_id,
            'paid_at' => now(),
        ]);

        $credit->delete();

        return back()->with('success', 'payee ');
    }
}
