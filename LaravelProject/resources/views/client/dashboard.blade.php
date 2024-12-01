<!DOCTYPE html>
<html lang="en">
<head>
    <title>Client Dashboard</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css">
    <style>
        .profil-link {
    position: absolute;
            top: 20px;
            left: 20px;
    text-decoration: none;
            color: #007bff;
            font-weight: bold;
}
.logout-link{
            position: absolute;
            top: 20px;
            right: 20px;
            text-decoration: none;
            color: #007bff;
            font-weight: bold;
        }

        .logout-link:hover,.profil-link:hover {
            color: #0056b3;
        }
    </style>
</head>
<body class="container mt-5">
    <a href="{{ route('client.profil') }}" class="profil-link" style="text-decoration: none;">Profil</a>
    <a href="{{ route('logout') }}"onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="logout-link">Se déconnecter &nbsp;<i class="fa-solid fa-right-from-bracket"></i></a>
    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
    </form>
    <h1 class="mb-4">Bienvenue, {{ $client->prenom }} {{ $client->nom }} !</h1>

    <!-- Bouton pour afficher le formulaire -->
    <button id="showFormBtn" class="btn btn-primary mb-3">Rechercher par numéro de suivi</button>

    <!-- Formulaire de recherche -->
    <form id="searchForm" style="display: none;" method="POST" action="{{ route('searchC') }}">
        @csrf
        <div class="mb-3">
            <label for="search" class="form-label">Rechercher par numéro de suivi</label>
            <input
                required
                pattern=".*\S.*"
                type="search"
                class="form-control"
                id="search"
                name="query"
                placeholder="Entrez le numéro de suivi">
        </div>
        <button type="submit" class="btn btn-success">Rechercher</button>
    </form>

    <br>
    <a href="{{ route('form_ajt_colis') }}" class="btn btn-secondary mb-4">Ajouter un Colis</a>

    <!-- Script pour gérer l'affichage du formulaire -->
    <script>
        document.getElementById('showFormBtn').addEventListener('click', function () {
            const form = document.getElementById('searchForm');
            form.style.display = 'block'; // Affiche le formulaire
            this.style.display = 'none'; // Cache le bouton
        });
    </script>

    <!-- Détails du colis -->
    @if(isset($colisData))
        <h2 class="mb-4">Détails du Colis</h2>
        <table class="table table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>Champ</th>
                    <th>Valeur</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Numéro de suivi</td>
                    <td>{{ $colisData['numero_suivi'] }}</td>
                </tr>
                <tr>
                    <td>Description</td>
                    <td>{{ $colisData['description'] }}</td>
                </tr>
                <tr>
                    <td>Contenu</td>
                    <td>{{ $colisData['contenu_colis'] }}</td>
                </tr>
                <tr>
                    <td>Statut</td>
                    <td>{{ $colisData['statut_colis'] }}</td>
                </tr>
                <tr>
                    <td>Poids</td>
                    <td>{{ $colisData['poids'] }}</td>
                </tr>
                <tr>
                    <td>Nom de l'expéditeur</td>
                    <td>{{ $colisData['expediteur_nom'] }}</td>
                </tr>
                <tr>
                    <td>Prénom de l'expéditeur</td>
                    <td>{{ $colisData['expediteur_prenom'] }}</td>
                </tr>
                <tr>
                    <td>Nom du destinataire</td>
                    <td>{{ $colisData['destinataire_nom'] }}</td>
                </tr>
                <tr>
                    <td>Prénom du destinataire</td>
                    <td>{{ $colisData['destinataire_prenom'] }}</td>
                </tr>
                <tr>
                    <td>Date de livraison</td>
                    <td>{{ $colisData['date_livraison'] }}</td>
                </tr>
                <tr>
                    <td>Date de Réception</td>
                    <td>{{ $colisData['date_reception'] }}</td>
                </tr>
            </tbody>
            <a href="{{ route('showDashClient') }}" class="btn  mt-3">🔙</a>
        </table>
    @elseif(session('error'))
        <div class="alert alert-danger mt-4">{{ session('error') }}</div>
    @endif
    {{-- <a href="{{ url()->previous() }}" class="btn btn-secondary mt-3">Retour</a> --}}

</body>
</html>
