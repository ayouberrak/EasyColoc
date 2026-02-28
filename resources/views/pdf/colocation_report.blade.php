<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Rapport de Colocation</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 14px;
            color: #333;
            margin: 0;
            padding: 20px;
        }
        h1 {
            color: #2563eb;
            text-align: center;
            border-bottom: 2px solid #e5e7eb;
            padding-bottom: 10px;
        }
        h2 {
            color: #1e40af;
            margin-top: 30px;
            border-bottom: 1px solid #e5e7eb;
            padding-bottom: 5px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
            margin-bottom: 20px;
        }
        th, td {
            border: 1px solid #d1d5db;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f3f4f6;
            font-weight: bold;
        }
        .text-right {
            text-align: right;
        }
        .text-center {
            text-align: center;
        }
        .total-box {
            background-color: #eff6ff;
            border: 1px solid #bfdbfe;
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 5px;
        }
        .badge {
            display: inline-block;
            padding: 3px 8px;
            font-size: 11px;
            border-radius: 10px;
            background-color: #e5e7eb;
            color: #374151;
        }
        .footer {
            margin-top: 50px;
            text-align: center;
            font-size: 12px;
            color: #6b7280;
            border-top: 1px solid #e5e7eb;
            padding-top: 10px;
        }
    </style>
</head>
<body>

    <h1>Rapport de Colocation : {{ $colocation->name }}</h1>
    
    <p><strong>Propriétaire :</strong> {{ $owner->name }} ({{ $owner->email }})</p>
    <p><strong>Date de génération :</strong> {{ date('d/m/Y H:i') }}</p>

    <div class="total-box">
        <h3 style="margin-top: 0;">Résumé Financier</h3>
        <p><strong>Total des Dépenses :</strong> {{ number_format($totalExpenses, 2) }} DH</p>
        <p><strong>Total des Paiements :</strong> {{ number_format($totalPayments, 2) }} DH</p>
        <p><strong>Balance (Paiements - Dépenses) :</strong> 
            <span style="color: {{ ($totalPayments - $totalExpenses) >= 0 ? 'green' : 'red' }}">
                {{ number_format($totalPayments - $totalExpenses, 2) }} DH
            </span>
        </p>
    </div>

    <h2>Membres Actifs</h2>
    <table>
        <thead>
            <tr>
                <th>Nom</th>
                <th>Email</th>
                <th>Date d'arrivée</th>
            </tr>
        </thead>
        <tbody>
            @foreach($members as $member)
            <tr>
                <td>{{ $member->user->name }}</td>
                <td>{{ $member->user->email }}</td>
                <td>{{ \Carbon\Carbon::parse($member->joined_at)->format('d/m/Y') }}</td>
            </tr>
            @endforeach
            @if($members->isEmpty())
            <tr>
                <td colspan="3" class="text-center">Aucun membre actif.</td>
            </tr>
            @endif
        </tbody>
    </table>

    <h2>Dépenses Récentes</h2>
    <table>
        <thead>
            <tr>
                <th>Date</th>
                <th>Catégorie</th>
                <th>Payé par</th>
                <th class="text-right">Montant</th>
            </tr>
        </thead>
        <tbody>
            @foreach($expenses->take(15) as $expense)
            <tr>
                <td>{{ \Carbon\Carbon::parse($expense->date)->format('d/m/Y') }}</td>
                <td>{{ $expense->category ? $expense->category->name : 'N/A' }}</td>
                <td>{{ $expense->payer ? $expense->payer->name : 'N/A' }}</td>
                <td class="text-right">{{ number_format($expense->amount, 2) }} DH</td>
            </tr>
            @endforeach
            @if($expenses->isEmpty())
            <tr>
                <td colspan="4" class="text-center">Aucune dépense enregistrée.</td>
            </tr>
            @endif
        </tbody>
    </table>

    <h2>Paiements Effectués</h2>
    <table>
        <thead>
            <tr>
                <th>Date</th>
                <th>Membre</th>
                <th>Preuve</th>
                <th class="text-right">Montant</th>
            </tr>
        </thead>
        <tbody>
            @foreach($payments as $payment)
            <tr>
                <td>{{ \Carbon\Carbon::parse($payment->date)->format('d/m/Y') }}</td>
                <td>{{ $payment->user ? $payment->user->name : 'N/A' }}</td>
                <td>{{ $payment->proof_path ? 'Fournie' : 'Non' }}</td>
                <td class="text-right">{{ number_format($payment->amount, 2) }} DH</td>
            </tr>
            @endforeach
            @if($payments->isEmpty())
            <tr>
                <td colspan="4" class="text-center">Aucun paiement enregistré.</td>
            </tr>
            @endif
        </tbody>
    </table>

    <h2>Dettes Actuelles</h2>
    <table>
        <thead>
            <tr>
                <th>Doit payer (Débiteur)</th>
                <th>Doit recevoir (Créancier)</th>
                <th class="text-right">Montant</th>
            </tr>
        </thead>
        <tbody>
            @foreach($credit as $credi)
            @if($credi->amount > 0)
            <tr>
                <td>{{ $credi->debtor ? $credi->debtor->name : 'N/A' }}</td>
                <td>{{ $credi->creditor ? $credi->creditor->name : 'N/A' }}</td>
                <td class="text-right">{{ number_format($credi->amount, 2) }} DH</td>
            </tr>
            @endif
            @endforeach
            @if($credit->isEmpty() || $credit->sum('amount') == 0)
            <tr>
                <td colspan="3" class="text-center">Aucune dette en cours.</td>
            </tr>
            @endif
        </tbody>
    </table>

</body>
</html>
