<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Rapport Personnalisé - Dashboard</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; font-size: 12px; }
        h1, h2 { color: #333; }
        .section { margin-bottom: 20px; }
    </style>
</head>
<body>
    <h1>Rapport Personnalisé du Dashboard</h1>
    <p>Période: {{ $periode['debut'] }} à {{ $periode['fin'] }} ({{ $export_info['date_export'] }})</p>

    @if(isset($utilisateurs))
        <div class="section">
            <h2>Utilisateurs</h2>
            <p>Total : {{ $utilisateurs['total'] }}</p>
            <p>Evolution : {{ $utilisateurs['evolution'] }} %</p>
        </div>
    @endif

    @if(isset($revenus))
        <div class="section">
            <h2>Revenus</h2>
            <p>Total : {{ number_format($revenus['total'], 2, ',', ' ') }} €</p>
            <p>Evolution : {{ $revenus['evolution'] }} %</p>
        </div>
    @endif

    @if(isset($abonnements))
        <div class="section">
            <h2>Abonnements</h2>
            <p>Total abonnés confirmés : {{ $abonnements['total'] }}</p>
            <p>Evolution : {{ $abonnements['evolution'] }} %</p>
        </div>
    @endif

    @if(isset($rendezvous))
        <div class="section">
            <h2>Rendez-vous</h2>
            <p>Total : {{ $rendezvous['total'] }}</p>
            <p>Evolution : {{ $rendezvous['evolution'] }} %</p>
        </div>
    @endif

    @if(isset($messages))
        <div class="section">
            <h2>Messages</h2>
            <p>Total : {{ $messages['total'] }}</p>
            <p>Non lus : {{ $messages['non_lus'] }}</p>
        </div>
    @endif
</body>
</html>
