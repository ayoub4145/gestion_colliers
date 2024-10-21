<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin-Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
    <button type="button">Profil</button>
    <h1 style="text-align:center;color:gray">Bonjour Admin</h1>
    <hr>
    <br>
    <br>
    <a href="{{ route('showForm') }}">Ajouter un livreur</a>
    <table class="table">
        <tr>
        <th>Id_livreur</th>
        <th>Nom</th>
        <th>Prénom</th>
        <th>Adresse</th>
        <th>Statut</th>
        <th>Email</th>
        <th>Téléphone</th>
        </tr>
        @foreach ($liste_livreurs as $livreur)
        <tr>
            <td>{{ $livreur->id }}</td>
            <td>{{ $livreur->nom }}</td>
            <td>{{ $livreur->prenom }}</td>
            <td>{{ $livreur->adresse }}</td>
            <td>{{ $livreur->statut_livreur }}</td>
            <td>{{ $livreur->email }}</td>
            <td>{{ $livreur->telephone }}</td>
        </tr>
        @endforeach
    </table>
    {{ $liste_livreurs->links() }}

</body>
</html>
