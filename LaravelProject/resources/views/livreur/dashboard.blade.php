<!-- resources/views/colis/affectation_result.blade.php -->
<!DOCTYPE html>
<html>
<head>
    <title>Affectation des Colis</title>
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
<body>
    <a href="{{ route('livreur.profil') }}" class="profil-link" style="text-decoration: none;">Profil</a>
    <a href="{{ route('logout') }}"onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="logout-link">Se déconnecter &nbsp;<i class="fa-solid fa-right-from-bracket"></i></a>
    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
    </form>
    <pre>
        <h1 class="mb-4">Bienvenue, {{ $livreur->prenom }} {{ $livreur->nom }} !</h1>
        <h1>Mes Colis</h1>
    </pre>

    <h2 class="mt-4">Colis Affectés</h2>

    @if(isset($colisAffectes) && $colisAffectes->count() > 0)
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Numéro de suivi</th>
                <th>Description</th>
                <th>Statut</th>
                <th>Date de livraison</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($colisAffectes as $colis)
                <tr>
                    <td>{{ $colis->numero_suivi }}</td>
                    <td>{{ $colis->description }}</td>
                    <td>{{ $colis->statut_colis }}</td>
                    <td>{{ $colis->date_livraison }}</td>
                    <td>
                        <!-- Ajouter des actions comme "Marquer comme livré", etc. -->
                        {{-- <a href="{{ route('colis.details', $colis->id) }}" class="btn btn-info btn-sm">Voir Détails</a> --}}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    @else
    <p>Aucun colis n'a été affecté à ce livreur.</p>
    @endif

</div>
</body>
</html>
