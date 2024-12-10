<!-- resources/views/colis/affectation_result.blade.php -->
<!DOCTYPE html>
<html>
<head>
    <title>Tableau de bord</title>
    {{-- <meta http-equiv="refresh" content="3;url={{route('showDashLivreur')}}"> --}}
    <meta charset="UTF-8">
    <style>
        /* Général */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f8f9fa;
            color: #333;
        }
    
        h1, h2 {
            text-align: center;
            margin-top: 20px;
        }
    
        h1 {
            color: #4CAF50;
        }
    
        h2 {
            margin-top: 40px;
            color: #007bff;
        }
    
        p {
            text-align: center;
            margin-top: 10px;
            font-size: 18px;
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
    
        /* Tableau */
        table {
            width: 90%;
            margin: 20px auto;
            border-collapse: collapse;
            background-color: #fff;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
    
        th, td {
            text-align: center;
            padding: 10px;
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
    
        /* Boutons */
        button, a {
            display: inline-block;
            padding: 5px 10px;
            margin: 5px;
            text-decoration: none;
            border-radius: 5px;
            font-size: 14px;
            transition: background-color 0.3s ease;
            cursor: pointer;
        }
    
        button {
            border: none;
            color: white;
        }
    
        button.btn-success {
            background-color: #28a745;
        }
    
        button.btn-success:hover {
            background-color: #218838;
        }
    
        button.btn-warning {
            background-color: #ffc107;
            color: black;
        }
    
        button.btn-warning:hover {
            background-color: #e0a800;
        }
    
        a {
            color: #007bff;
            background-color: #f8f9fa;
            border: 1px solid #007bff;
        }
    
        a:hover {
            background-color: #007bff;
            color: white;
        }
    
        /* Messages */
        .alert {
            width: 80%;
            margin: 10px auto;
            padding: 10px;
            border-radius: 5px;
            text-align: center;
            font-size: 14px;
        }
    
        .alert-success {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }
    
        .alert-danger {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
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
