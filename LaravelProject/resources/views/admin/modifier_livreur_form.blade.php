<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier Livreur</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h2>Modifier Livreur</h2>
        <!-- Affichage du message de succès dans la vue 'showDashAdmin' -->
            @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
            @endif

        <form action="{{ route('modifLivreur', $livreur->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="nom" class="form-label">Nom</label>
                <input type="text" name="nom" id="nom" class="form-control" value="{{ $livreur->nom }}" required>
            </div>

            <div class="mb-3">
                <label for="prenom" class="form-label">Prénom</label>
                <input type="text" name="prenom" id="prenom" class="form-control" value="{{ $livreur->prenom }}" required>
            </div>

            <div class="mb-3">
                <label for="adresse" class="form-label">Adresse</label>
                <input type="text" name="adresse" id="adresse" class="form-control" value="{{ $livreur->adresse }}">
            </div>

            <div class="mb-3">
                <label class="form-label">Statut</label><br>
                <input type="radio" name="statut" value="1" {{ $livreur->statut_livreur ? 'checked' : '' }}> Disponible
                <input type="radio" name="statut" value="0" {{ !$livreur->statut_livreur ? 'checked' : '' }}> Occupé
            </div>
            <div class="mb-3">
                <label for="cin" class="form-label">CIN</label>
                <input type="text" name="cin" id="cin" class="form-control" value="{{ $livreur->cin }}" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" name="email" id="email" class="form-control" value="{{ $livreur->email }}" required>
            </div>

            <div class="mb-3">
                <label for="telephone" class="form-label">Téléphone</label>
                <input type="tel" name="telephone" id="telephone" class="form-control" value="{{ $livreur->telephone }}" required>
            </div>

            <button type="submit" class="btn btn-primary">Enregistrer les modifications</button>
            <a href="{{ route('showDashAdmin') }}" class="btn btn-secondary">Annuler</a>
        </form>
    </div>
</body>
</html>
