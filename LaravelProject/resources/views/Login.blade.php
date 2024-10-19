<!-- resources/views/Login.blade.php -->
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
</head>
<body>
    <h1>Connexion</h1>

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
        @csrf <!-- Protection CSRF -->

        <!-- Champ caché pour le type d'utilisateur -->
        <input type="hidden" name="user_type" id="hidden_user_type" value="">

        <label for="email">Email :</label>
        <input type="email" name="email" id="email" required>

        <label for="password">Mot de passe :</label>
        <input type="password" name="password" id="password" required minlength="4">

        <button type="submit">Se connecter</button>
    </form>

    <script>

    // // Fonction pour définir le type d'utilisateur dans le champ caché
    // function setUserType(userType) {
    //     document.getElementById('hidden_user_type').value = userType;
    // }

    // // Exemple d'utilisation : mettre à jour le type d'utilisateur en fonction d'un paramètre dans l'URL
    // const urlParams = new URLSearchParams(window.location.search);
    // const userType = urlParams.get('user_type');

    // if (userType === 'admin' || userType === 'livreur' || userType === 'client') {
    //     setUserType(userType);
    // } else {
    //     // Si aucun type d'utilisateur n'est spécifié, rediriger ou afficher un message d'erreur
    //     alert('Veuillez spécifier un type d’utilisateur valide (client, admin, livreur).');
    //     // Vous pouvez rediriger vers la page de connexion ou une autre page
    //     window.location.href = '/login'; // Remplacez '/login' par l'URL de votre page de connexion
    // }
</script>


</body>
</html>
