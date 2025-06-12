<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <form method="POST" action="{{ route('password.update') }}">
        @csrf
        <input type="hidden" name="token" value="{{ $token }}">
        <input type="email" name="email" placeholder="Votre email" required>
        <input type="password" name="password" placeholder="Nouveau mot de passe" required>
        <input type="password" name="password_confirmation" placeholder="Confirmer mot de passe" required>
        <button type="submit">Réinitialiser</button>
    </form>
    
</body>
</html>