<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css">
    <title>Ajouter colis</title>
</head>
<body>
    <h1 class="text-center mb-4">Ajouter un Colis</h1>
<div class="container mt-5">
    <form action="{{ route('colis.store') }}" method="POST">
        @csrf
    <!-- Informations du colis -->
        <h4>Informations du Colis</h4>
        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <input type="text" class="form-control" id="description" name="description" required>
        </div>
        <div class="mb-3">
            <label for="contenu_colis" class="form-label">Contenu du Colis</label>
            <input type="text" class="form-control" id="contenu_colis" name="contenu_colis" required>
        </div>
        <div class="mb-3">
            <label for="poids" class="form-label">Poids (en kg)</label>
            <input type="number" class="form-control" id="poids" name="poids" step="0.01" required>
        </div>
        {{-- <div class="mb-3">
            <label for="prix" class="form-label">Prix (en MAD)</label>
            <input type="number" class="form-control" id="prix" name="prix" step="0.01" required>
        </div> --}}

        <!-- Informations du destinataire -->
        <h4 class="mt-4">Informations du Destinataire</h4>
        <div class="mb-3">
            <label for="nom_destinataire" class="form-label">Nom</label>
            <input type="text" class="form-control" id="nom_destinataire" name="nom_destinataire" required>
        </div>
        <div class="mb-3">
            <label for="prenom_destinataire" class="form-label">Prénom</label>
            <input type="text" class="form-control" id="prenom_destinataire" name="prenom_destinataire" required>
        </div>
        <div class="mb-3">
            <label for="cin" class="form-label">CIN</label>
            <input type="text" class="form-control" id="cin" name="cin" required>
        </div>
        <div class="mb-3">
            <label for="adresse_destinataire" class="form-label">Adresse</label>
            <input type="text" class="form-control" id="adresse_destinataire" name="adresse_destinataire" required>
        </div>
        <div class="mb-3">
            <label for="ville" class="form-label">Ville</label>
            <input type="text" class="form-control" id="ville" name="ville" required>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="text" class="form-control" id="email" name="email" required>
        </div>
        <div class="mb-3">
            <label for="telephone_destinataire" class="form-label">Numéro de Téléphone</label>
            <input type="text" class="form-control" id="telephone_destinataire" name="telephone_destinataire" required>
        </div>

        <!-- Bouton de soumission -->
        <div class="text-center mt-4">
            <button type="submit" class="btn btn-primary">Ajouter le Colis</button>
            <a href="{{route('showDashClient')}}" class="btn btn-danger">Annuler</a>

        </div>
    </form>
</div>

</body>
</html>
