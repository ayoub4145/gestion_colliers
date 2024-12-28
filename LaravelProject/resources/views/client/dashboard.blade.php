<!DOCTYPE html>
<html lang="en">
<head>
    <title>Client Dashboard</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css">
    <style>
        /* Style global */
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f8f9fa;
            color: #333;
            padding-top: 20px;
        }
    
        h1, h2 {
            text-align: center;
            color: #4CAF50;
            font-size: 28px;
            margin-bottom: 20px;
        }
    
        /* Liens */
        .profil-link, .logout-link {
            position: absolute;
            top: 20px;
            font-weight: bold;
            text-decoration: none;
            padding: 5px 10px;
            border-radius: 5px;
            font-size: 14px;
            transition: background-color 0.3s ease;
        }
    
        .profil-link {
            left: 20px;
            color: #fff;
            background-color: #007bff;
        }
    
        .logout-link {
            right: 20px;
            color: #fff;
            background-color: #dc3545;
        }
    
        .profil-link:hover {
            background-color: #0056b3;
        }
    
        .logout-link:hover {
            background-color: #c82333;
        }
    
        /* Formulaire */
        .form-label {
            font-size: 16px;
        }
    
        #searchForm {
            display: none;
            margin-bottom: 20px;
        }
    
        .btn-primary, .btn-success, .btn-secondary {
            width: 100%;
            font-size: 16px;
        }
    
        .btn-primary:hover {
            background-color: #0056b3;
        }
    
        .btn-success:hover {
            background-color: #218838;
        }
    
        .btn-secondary:hover {
            background-color: #6c757d;
        }
    
        /* Table */
        table {
            width: 80%;
            margin: 20px auto;
            background-color: #fff;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
    
        th, td {
            text-align: left;
            padding: 12px;
            border: 1px solid #ddd;
        }
    
        th {
            background-color: #007bff;
            color: white;
            font-weight: bold;
        }
    
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
    
        tr:hover {
            background-color: #e9ecef;
        }
    
        .alert-danger {
            color: #721c24;
            background-color: #f8d7da;
            border-color: #f5c6cb;
            font-size: 16px;
            text-align: center;
        }
    
        /* Button for back action */
        .btn {
            margin-top: 20px;
        }
    
        /* Card for better info visibility */
        .card {
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 20px;
            margin: 20px;
        }
    
        .card-header {
            background-color: #f1f1f1;
            font-weight: bold;
            font-size: 18px;
            padding: 10px;
        }
    
        .card-body {
            font-size: 16px;
        }
    
        .card-body p {
            margin-bottom: 10px;
        }
    
        .card-footer {
            background-color: #f1f1f1;
            text-align: center;
            padding: 10px;
        }
    
    </style>
    </head>
<body class="container mt-5">
    <a href="{{ route('client.profil') }}" class="profil-link" style="text-decoration: none;">Profil</a>
    <a href="{{ route('logoutClient') }}"onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="logout-link">Se déconnecter &nbsp;<i class="fa-solid fa-right-from-bracket"></i></a>
    <form id="logout-form" action="{{ route('logoutClient') }}" method="POST" style="display: none;">
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
    @section('content')
    {{-- <h1>Tableau de bord</h1>

    <p>{{ $message }}</p>

    @if ($colis)
        <h2>Informations du colis</h2>
        <p>ID : {{ $colis->id }}</p>
        <p>Description : {{ $colis->description }}</p>
    @endif

    @if ($livreur)
        <h2>Informations du livreur</h2>
        <p>Nom : {{ $livreur->nom }}</p>
        <p>Réclamation : {{ $livreur->reclamation }}</p>
    @else
        <p>Aucun livreur trouvé pour ce colis.</p>
    @endif
@endsection --}}
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
                <tr>
                    <td>État du colis</td>
                    <td>
                        @if(isset($colisData['statut_colis']))
                            {{ $colisData['statut_colis'] }}
                        @else
                            {{ $message  ?? 'Aucune information disponible' }}
                        @endif
                    </td>
                </tr>
                <tr>
                    <tr>
                        <td>Réclamation du colis</td>
                        <td>
                            @if(isset($colisData['reclamation']))
                                {{ $colisData['reclamation'] }}
                            @else
                                Aucun problème signalé.
                            @endif
                        </td>
                    </tr>
                    
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
