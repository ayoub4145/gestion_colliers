<!DOCTYPE html>
<html lang="en">
<head>
    <title>Client dashboard</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h1>Bienvenue, {{ $client->prenom }} {{ $client->nom }} !</h1>
        <a href="{{route('form_ajt_colis')}}" class="text-center mb-4">Ajouter un Colis</a>
    </div>
</body>
</html>

