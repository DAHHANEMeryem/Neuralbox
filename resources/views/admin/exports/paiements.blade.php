<!DOCTYPE html>
<html>
<head>
    <title>Liste des paiements</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
        h1 { text-align: center; }
    </style>
</head>
<body>
    <h1>Liste des paiements</h1>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Utilisateur</th>
                <th>Montant</th>
                <th>Méthode de paiement</th>
                <th>Date de paiement</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach($payments as $payment)
            <tr>
                <td>{{ $payment->id }}</td>
                <td>{{ $payment->user->name ?? 'N/A' }}</td>
                <td>{{ number_format($payment->amount, 2, ',', ' ') }} DH</td>
                <td>{{ ucfirst($payment->method) }}</td>
                <td>{{ $payment->created_at->format('d/m/Y H:i') }}</td>
                <td>{{ ucfirst($payment->status) }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
