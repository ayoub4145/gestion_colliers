<!-- resources/views/colis/affectation_result.blade.php -->
<!DOCTYPE html>
<html>
<head>
    <title>Tableau de bord</title>
    {{-- <meta http-equiv="refresh" content="3;url={{route('showDashLivreur')}}"> --}}
    <meta charset="UTF-8">
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
    <a href="{{ route('logout') }}"onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="logout-link">Se déconnecter &nbsp;<i class="fa-solid fa-right-from-bracket"></i></a><br>
    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
    </form>

    <h1 style="text-align: center">Bienvenue, {{ $livreur->prenom }} {{ $livreur->nom }} !</h1>
    <p>Statut actuel :
        <strong>{{ Auth::guard('livreur')->user()->statut_livreur ? 'Disponible' : 'Occupé' }}</strong>
    </p>
    <!-- Bouton pour basculer le statut -->
    <form action="{{ route('affecter.livreur') }}" method="POST">
        @csrf
        <button type="submit" class="btn btn-sm {{ Auth::guard('livreur')->user()->statut_livreur ? 'btn-success' : 'btn-warning' }}">
            {{ Auth::guard('livreur')->user()->statut_livreur ? 'Occupé' : 'Disponible' }}
        </button>
    </form>

    <h2 class="mt-4">Colis Affectés</h2>
            @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @elseif(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif
        @if(isset($assignedColis))
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Numéro de suivi</th>
                    <th>Description</th>
                    <th>Statut</th>
                    <th>Poids</th>
                    <th>Date de livraison</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($assignedColis as $colis)
                    <tr>
                        <td>{{ $colis->numero_suivi }}</td>
                        <td>{{ $colis->description }}</td>
                        <td>{{ $colis->statut_colis }}</td>
                        <td>{{ $colis->poids }} kg</td>
                        <td>{{ $colis->date_livraison ? $colis->date_livraison : 'Non définie' }}</td>
                        <td>
                            <a href="{{route('accepter.livraison',$colis->id)}}">Accepter</a>
                            <a href="{{route('reclamer.livraison')}}">Livré </a>
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
