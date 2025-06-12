<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Rapport Complet - Dashboard</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; font-size: 12px; }
        h1, h2 { color: #333; }
        table { width: 100%; border-collapse: collapse; margin-bottom: 20px;}
        th, td { border: 1px solid #ccc; padding: 8px; text-align: left;}
        .section { margin-bottom: 40px; }
    </style>
</head>
<body>
    <h1>Rapport Complet du Dashboard</h1>
    <p>Période: {{ $periode['debut'] }} à {{ $periode['fin'] }} ({{ $export_info['date_export'] }})</p>

    <div class="section">
        <h2>Utilisateurs</h2>
        <p>Total : {{ $utilisateurs['total'] }}</p>
        <p>Evolution : {{ $utilisateurs['evolution'] }} %</p>
        <p>Nouveaux la semaine dernière : {{ $utilisateurs['nouveaux'] }}</p>
        <p>Parents : {{ $utilisateurs['parents'] }}</p>
        <p>Inactifs : {{ $utilisateurs['inactifs'] }}</p>
    </div>

    <div class="section">
        <h2>Revenus</h2>
        <p>Total : {{ number_format($revenus['total'], 2, ',', ' ') }} €</p>
        <p>Evolution : {{ $revenus['evolution'] }} %</p>
        <p>Moyenne par jour : {{ number_format($revenus['moyenne_par_jour'], 2, ',', ' ') }} €</p>

        <h3>Top paiements</h3>
        <table>
            <thead>
                <tr>
                    <th>Utilisateur</th>
                    <th>Montant</th>
                    <th>Date</th>
                </tr>
            </thead>
            <tbody>
                @foreach($revenus['top_paiements'] as $paiement)
                <tr>
                    <td>{{ $paiement->user->name ?? 'Inconnu' }}</td>
                    <td>{{ number_format($paiement->montant, 2, ',', ' ') }} €</td>
                    <td>{{ $paiement->created_at->format('d/m/Y') }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="section">
        <h2>Abonnements</h2>
        <p>Total abonnés confirmés : {{ $abonnements['total'] }}</p>
        <p>Evolution : {{ $abonnements['evolution'] }} %</p>
        <p>Abonnés actifs : {{ $abonnements['actifs'] }}</p>
        <p>Abonnements expirant bientôt : {{ $abonnements['expires_bientot'] }}</p>
    </div>

    <div class="section">
        <h2>Rendez-vous</h2>
        <p>Total : {{ $rendezvous['total'] }}</p>
        <p>Evolution : {{ $rendezvous['evolution'] }} %</p>
        <p>Acceptés : {{ $rendezvous['acceptes'] }}</p>
        <p>En attente : {{ $rendezvous['attente'] }}</p>
        <p>Annulés : {{ $rendezvous['annules'] }}</p>
        <p>Taux d'acceptation : {{ $rendezvous['taux_acceptation'] }} %</p>
    </div>

    <div class="section">
        <h2>Messages</h2>
        <p>Total : {{ $messages['total'] }}</p>
        <p>Non lus : {{ $messages['non_lus'] }}</p>
        <p>lus : {{ $messages['lus'] }}</p>
        <p>Taux de réponse : {{ $messages['taux_reponse'] }} %</p>
    </div>

    <div class="section">
        <h2>Activité récente</h2>
        <ul>
            @foreach($activite_recente as $activite)
                <li>[{{ $activite['date']->format('d/m/Y H:i') }}] {{ $activite['message'] }}</li>
            @endforeach
        </ul>
    </div>
</body>
</html>
