<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mon Compte</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h1>Bienvenue dans votre compte, {{ $user->name }}</h1>
        <p>Vous êtes connecté avec l'adresse email : {{ $user->email }}</p>
        
        <div class="mt-4">
            <p>Type de compte : {{ ucfirst($user->type) }}</p>
        </div>
        
        <div class="mt-4">
            <a href="{{ route('logout') }}"
                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                Déconnexion
            </a>
            
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        </div>
    </div>
</body>
</html>