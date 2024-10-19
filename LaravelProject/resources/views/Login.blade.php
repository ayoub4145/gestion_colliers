<!-- resources/views/Login.blade.php -->
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
    <link rel="stylesheet" href="{{ asset('css/login.css') }}"/>
</head>
<body>
    <x-TopBar/>
    <x-NavBar/>

    <!-- Afficher les erreurs de validation -->
    @if ($errors->any())
        <div>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="{{ route('login') }}" method="POST">
        <h1>Connexion</h1>

        @csrf <!-- Protection CSRF -->
        <label for="email">Email :</label>
        <input type="email" name="email" id="email" required>
        <br>
        <label for="password">Mot de passe :</label>
        <input type="password" name="password" id="password" required minlength="4">
        <br>
        <button type="submit">Se connecter</button><br>
        <i><a href="{{ route('RegisterForm') }}">S'inscrire</a></i>
    </form>
</body>
</html>
