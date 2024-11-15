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
    {{-- <h3>Bonjour {{$livreur->nom $livreur->prenom}}</h3> --}}
    <h1>Affectation des Colis aux Livreurs</h1>
    </pre>
    @if (isset($message))
        <p>{{ $message }}</p>
    @endif

    @if (isset($assignedColis) && count($assignedColis) > 0)
        <h2>Liste des Colis Affectés</h2>
        <table border="1">
            <thead>
                <tr>
                    <th>ID Colis</th>
                    <th>Statut Colis</th>
                    <th>ID Livreur</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($assignedColis as $colis)
                    <tr>
                        <td>{{ $colis->id }}</td>
                        <td>{{ $colis->statut_colis }}</td>
                        <td>{{ $colis->livreur_id }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p>Aucun colis n'a été affecté.</p>
    @endif
</body>
</html>
