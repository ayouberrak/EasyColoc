<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Colocation;
use App\Models\ColocationMember;
use App\Models\Expense;
use App\Models\Payment;
use App\Models\Credit;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;

class ExportController extends Controller
{
    public function exportColocationPdf(Request $request)
    {
        $user = Auth::user();
        
        $colocation = Colocation::where('user_id', $user->id)->first();
        
        if (!$colocation) {
            return redirect()->back()->with('error', 'no valid colocation');
        }

        $members = ColocationMember::with('user')
            ->where('colocation_id', $colocation->id)
            ->whereNull('left_at')
            ->get();
            
        $expenses = Expense::with(['payer', 'category'])
            ->where('colocation_id', $colocation->id)
            ->orderBy('date', 'desc')
            ->get();
            
        $payments = Payment::with('user')
            ->where('colocation_id', $colocation->id)
            ->orderBy('paid_at', 'desc')
            ->get();
            
        $credit = Credit::with(['debtor', 'creditor'])
            ->where('colocation_id', $colocation->id)
            ->get();

        $pdf = Pdf::loadView('pdf.colocation_report', [
            'colocation' => $colocation,
            'owner' => $user,
            'members' => $members,
            'expenses' => $expenses,
            'payments' => $payments,
            'credit' => $credit,
            'totalExpenses' => $expenses->sum('amount'),
            'totalPayments' => $payments->sum('amount')
        ]);

        return $pdf->download('Rapport_Colocation_' . date('Y-m-d') . '.pdf');
    }
}
