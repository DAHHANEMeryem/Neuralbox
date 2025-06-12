<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Rapport Résumé - Dashboard</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; font-size: 12px; }
        h1, h2 { color: #333; }
        p { margin-bottom: 10px; }
    </style>
</head>
<body>
    <h1>Rapport Résumé du Dashboard</h1>
    <p>Période: {{ $periode['debut'] }} à {{ $periode['fin'] }} ({{ $export_info['date_export'] }})</p>

    <h2>Statistiques clés</h2>
    <p>Utilisateurs totaux : {{ $utilisateurs['total'] }}</p>
    <p>Revenus totaux : {{ number_format($revenus['total'], 2, ',', ' ') }} €</p>
    <p>Abonnés confirmés : {{ $abonnements['total'] }}</p>
    <p>Rendez-vous totaux : {{ $rendezvous['total'] }}</p>
    <p>Messages reçus : {{ $messages['total'] }}</p>
</body>
</html>
