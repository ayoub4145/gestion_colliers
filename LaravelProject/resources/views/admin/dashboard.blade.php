<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Liste des livreurs</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/e39df68516.js" crossorigin="anonymous"></script>
    <style>
.result-container {
    background-color: #f0f4f8;
    border: 1px solid #d1d5db;
    padding: 15px;
    position: relative;
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    max-width: 500px;
    margin-top: 20px;
    font-family: Arial, sans-serif;
}

.close-button {
    position: absolute;
    top: 10px;
    right: 10px;
    background: none;
    border: none;
    font-size: 18px;
    cursor: pointer;
    color: #999;
}

.close-button:hover {
    color: #333;
}
.input {
  color: black;
  font: 1em/1.5 Hind, sans-serif;
}

form, .input, .caret {
  margin: auto;
}

form {
  position: relative;
  width: 100%;
  max-width: 17em;
}

.input, .caret {
  display: block;
  transition: all calc(1s * 0.5) linear;
}

.input {
  background: transparent;
  border-radius: 50%;
  box-shadow: 0 0 0 0.25em inset;
  caret-color: #255ff4;
  width: 2em;
  height: 2em;
  -webkit-appearance: none;
  -moz-appearance: none;
  appearance: none;
}

.input:focus, .input:valid {
  background: powderblue;
  border-radius: 0.25em;
  box-shadow: none;
  padding: 0.75em 1em;
  transition-duration: calc(1s * 0.25);
  transition-delay: calc(1s * 0.25);
  width: 100%;
  height: 3em;
}

.input:focus {
  animation: showCaret 1s steps(1);
  outline: transparent;

}

.input:focus + .caret, .input:valid + .caret {
  animation: handleToCaret 1s linear;
  background: transparent;
  width: 1px;
  height: 1.5em;
  transform: translate(0,-1em) rotate(-180deg) translate(7.5em,-0.25em);
}

.input::-webkit-search-decoration {
  -webkit-appearance: none;
}

label {
  color: #e3e4e8;
  overflow: hidden;
  position: absolute;
  width: 0;
  height: 0;
}

.caret {
  background: black;
  border-radius: 0 0 0.125em 0.125em;
  margin-bottom: -0.6em;
  width: 0.25em;
  height: 1em;
  transform: translate(0,-1em) rotate(-45deg) translate(0,0.875em);
  transform-origin: 50% 0;
}

/* Animations */
@keyframes showCaret {
  from {
    caret-color: transparent;
  }

  to {
    caret-color: #255ff4;
  }
}

@keyframes handleToCaret {
  from {
    background: currentColor;
    width: 0.25em;
    height: 1em;
    transform: translate(0,-1em) rotate(-45deg) translate(0,0.875em);
  }

  25% {
    background: currentColor;
    width: 0.25em;
    height: 1em;
    transform: translate(0,-1em) rotate(-180deg) translate(0,0.875em);
  }

  50%, 62.5% {
    background: #255ff4;
    width: 1px;
    height: 1.5em;
    transform: translate(0,-1em) rotate(-180deg) translate(7.5em,2.5em);
  }

  75%, 99% {
    background: #255ff4;
    width: 1px;
    height: 1.5em;
    transform: translate(0,-1em) rotate(-180deg) translate(7.5em,-0.25em);
  }

  87.5% {
    background: #255ff4;
    width: 1px;
    height: 1.5em;
    transform: translate(0,-1em) rotate(-180deg) translate(7.5em,0.125em);
  }

  to {
    background: transparent;
    width: 1px;
    height: 1.5em;
    transform: translate(0,-1em) rotate(-180deg) translate(7.5em,-0.25em);
  }
}
/* From Uiverse.io by aadium */
.card {
  width: 230px;
  height: 280px;
  border-radius: 2em;
  padding: 10px;
  background-color: #191919;
  box-shadow: 5px 5px 30px rgb(4, 4, 4),
                   -5px -5px 30px rgb(57, 57, 57);
}

.profileimage {
  background-color: transparent;
  border: none;
  margin-top: 20px;
  border-radius: 5em;
  width: 100px;
  height: 100px;
}

.pfp {
  border-radius: 35em;
  fill: white;
}

.Name {
  color: white;
  font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;
  padding: 15px;
  font-size: 20px;
  margin-top: 10px;
}
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
    <a href="{{ route('admin.profil') }}" class="profil-link" style="text-decoration: none;">Profil</a>
    <a href="{{ route('logout') }}"onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="logout-link">Se déconnecter &nbsp;<i class="fa-solid fa-right-from-bracket"></i></a>
    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
    </form>
    <h1 style="text-align:center;color:gray">Bonjour Admin</h1>
        <hr>
        <form id="searchForm" method="POST" action="{{route('search')}}">
            @csrf
            <label for="search">Search by Tracking Number</label>
            <input required pattern=".*\S.*" type="search" class="input" id="search" name="query" placeholder="Enter tracking number">
            <span class="caret"></span>
        </form>

        <div id="result" class="result-container" style="display: none;">
            <button id="closeButton" class="close-button">&times;</button>
            <!-- Les résultats seront affichés ici -->
        </div>

        <script>
            document.addEventListener('DOMContentLoaded', function () {

            document.getElementById('searchForm').addEventListener('submit', async function (event) {
    event.preventDefault();

    const formData = new FormData(this);
    const resultDiv = document.getElementById('result');

    if (!resultDiv) {
        console.error("Erreur : le div 'result' n'a pas été trouvé dans le DOM.");
        return;
    }

    try {
        const response = await fetch(this.action, {
            method: 'POST',
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'X-CSRF-Token': document.querySelector('input[name="_token"]').value,

            },
            body: formData
        });

        if (!response.ok) {
            console.error("Erreur de réponse :", response.statusText);
            resultDiv.innerHTML = `<p>Erreur de récupération des données.</p>`;
            return;
        }
        const data = await response.json(); // Récupérer les données JSON dans objet JS
        console.log("Données reçues :", data); // Vérifiez que les données sont bien reçues ici
        // Afficher le div
        resultDiv.style.display = 'block';
        console.log("Contenu du div avant mise à jour :", resultDiv.innerHTML);

        // Utiliser les données reçues pour mettre à jour le contenu du div
        if (data) {
            resultDiv.innerHTML = `
                <p>Numéro de Suivi : ${data.numero_suivi}</p>
                <p>Description : ${data.description}</p>
                <p>Contenu : ${data.contenu_colis}</p>
                <p>Statut : ${data.statut_colis}</p>
                <p>Poids : ${data.poids} kg</p>
                <p>Prix : ${data.prix} €</p>
                <p>Expéditeur : ${data.expediteur_nom} ${data.expediteur_prenom}</p>
                <p>Destinataire : ${data.destinataire_nom} ${data.destinataire_prenom}</p>
                <p>Livreur : ${data.livreur_nom} ${data.livreur_prenom}</p>
                <p>Date de Livraison : ${data.date_livraison}</p>
            `;
        }
        console.log("Contenu du div apres mise à jour :", resultDiv.innerHTML);
else {
            resultDiv.innerHTML = `<p>Aucune donnée à afficher.</p>`; // Afficher un message si aucune donnée
        }
    } catch (error) {
        console.error("Erreur de requête :", error);
        resultDiv.innerHTML = `<p>Une erreur s'est produite lors de la récupération des données.</p>`;
        resultDiv.style.display = 'block'; // Affiche le div même en cas d'erreur
    }
});
            });
        </script>

        <!-- Affichage du message de succès dans la vue 'showDashAdmin' -->
        @if(session('success'))
        <div class="alert alert-success" id="success-alert">
            {{ session('success') }}
        </div>
        @endif
        <script>
            // Fonction pour masquer l'alerte après 5 secondes (5000 millisecondes)
            setTimeout(function() {
                let alert = document.getElementById('success-alert');
                if (alert) {
                    alert.classList.add('fade');
                    setTimeout(() => alert.style.display = 'none', 300); // Disparaît complètement
                }
            }, 5000); // 5000ms = 5 secondes
        </script>

    <div class="container my-4">
        <!-- Bouton pour charger le formulaire -->
        <a href="#" id="loadForm" class="btn btn-primary mb-3">Ajouter un livreur</a>

        <!-- Section pour afficher la liste des livreurs -->
        <div id="livreursContainer">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Id livreur</th>
                        <th>Nom</th>
                        <th>Prénom</th>
                        <th>Adresse</th>
                        <th>Statut</th>
                        <th>CIN</th>
                        <th>Email</th>
                        <th>Téléphone</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($liste_livreurs as $livreur)
                    <tr>
                        <td>{{ $livreur->id }}</td>
                        <td>{{ $livreur->nom }}</td>
                        <td>{{ $livreur->prenom }}</td>
                        <td>{{ $livreur->adresse }}</td>
                        <td>{{ $livreur->statut_livreur ? 'Disponible' : 'Occupé' }}</td>
                        <td>{{$livreur->cin_livreur}}</td>
                        <td>{{ $livreur->email }}</td>
                        <td>{{ $livreur->telephone }}</td>
                        <td><a href="{{route('livreur_mod',$livreur->id)}}"><i class="fa-solid fa-pen-to-square"></i></a>
                            <form action="{{ route('livreur.delete', $livreur->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce livreur ?');" style="background:none; border:none; color:red;">
                                    <i class="fa-solid fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            <!-- Pagination -->
            <div class="d-flex justify-content-center">
                {{ $liste_livreurs->links() }}
            </div>
        </div>

        <!-- Section pour afficher le formulaire après avoir cliqué sur "Ajouter un livreur" -->
        <div id="formContainer" style="display: none;"></div>

        <!-- Bouton de retour pour revenir à la liste -->
        <a href="#" id="returnToList" class="btn btn-secondary mb-3" style="display: none;">Retour à la liste</a>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#loadForm').on('click', function(e) {
                e.preventDefault();

                // Requête AJAX pour charger le contenu du formulaire
                $.ajax({
                    url: "{{ route('showForm') }}", // URL de la route Laravel pour afficher le formulaire
                    type: "GET",
                    success: function(response) {
                        // Masquer la liste des livreurs et afficher le formulaire
                        $('#livreursContainer').hide();
                        $('#formContainer').html(response).show();
                        $('#returnToList').show(); // Afficher le bouton de retour
                    },
                    error: function(xhr, status, error) {
                alert("Erreur lors du chargement du formulaire.");
            }
                });
            });

            // Gestion du bouton de retour pour revenir à la liste
            $('#returnToList').on('click', function(e) {
                e.preventDefault();
                $('#formContainer').hide(); // Masquer le formulaire
                $('#livreursContainer').fadeIn(); // Afficher la liste
                $('#returnToList').hide(); // Cacher le bouton de retour
            });
        });
    </script>
</body>
</html>
