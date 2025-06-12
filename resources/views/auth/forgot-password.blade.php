<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <form method="POST" action="{{ route('password.email') }}">
        @csrf
        <input type="email" name="email" placeholder="Votre email" required>
        <button type="submit">Envoyer le lien de réinitialisation</button>
    </form>
    
</body>
</html>