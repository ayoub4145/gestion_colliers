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
    </style>
</head>
<body>
  <button type="button" id="boutonProfil">Profil</button>
  <div class="card" id="profilCard" style="display: none;">
    <center>
      <div class="profileimage" id="profileImage">
      <svg class="pfp" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 122.88 122.88"><g><path d="M61.44,0c8.32,0,16.25,1.66,23.5,4.66l0.11,0.05c7.47,3.11,14.2,7.66,19.83,13.3l0,0c5.66,5.65,10.22,12.42,13.34,19.95 c3.01,7.24,4.66,15.18,4.66,23.49c0,8.32-1.66,16.25-4.66,23.5l-0.05,0.11c-3.12,7.47-7.66,14.2-13.3,19.83l0,0 c-5.65,5.66-12.42,10.22-19.95,13.34c-7.24,3.01-15.18,4.66-23.49,4.66c-8.31,0-16.25-1.66-23.5-4.66l-0.11-0.05 c-7.47-3.11-14.2-7.66-19.83-13.29L18,104.87C12.34,99.21,7.78,92.45,4.66,84.94C1.66,77.69,0,69.76,0,61.44s1.66-16.25,4.66-23.5 l0.05-0.11c3.11-7.47,7.66-14.2,13.29-19.83L18.01,18c5.66-5.66,12.42-10.22,19.94-13.34C45.19,1.66,53.12,0,61.44,0L61.44,0z M16.99,94.47l0.24-0.14c5.9-3.29,21.26-4.38,27.64-8.83c0.47-0.7,0.97-1.72,1.46-2.83c0.73-1.67,1.4-3.5,1.82-4.74 c-1.78-2.1-3.31-4.47-4.77-6.8l-4.83-7.69c-1.76-2.64-2.68-5.04-2.74-7.02c-0.03-0.93,0.13-1.77,0.48-2.52 c0.36-0.78,0.91-1.43,1.66-1.93c0.35-0.24,0.74-0.44,1.17-0.59c-0.32-4.17-0.43-9.42-0.23-13.82c0.1-1.04,0.31-2.09,0.59-3.13 c1.24-4.41,4.33-7.96,8.16-10.4c2.11-1.35,4.43-2.36,6.84-3.04c1.54-0.44-1.31-5.34,0.28-5.51c7.67-0.79,20.08,6.22,25.44,12.01 c2.68,2.9,4.37,6.75,4.73,11.84l-0.3,12.54l0,0c1.34,0.41,2.2,1.26,2.54,2.63c0.39,1.53-0.03,3.67-1.33,6.6l0,0 c-0.02,0.05-0.05,0.11-0.08,0.16l-5.51,9.07c-2.02,3.33-4.08,6.68-6.75,9.31C73.75,80,74,80.35,74.24,80.7 c1.09,1.6,2.19,3.2,3.6,4.63c0.05,0.05,0.09,0.1,0.12,0.15c6.34,4.48,21.77,5.57,27.69,8.87l0.24,0.14 c6.87-9.22,10.93-20.65,10.93-33.03c0-15.29-6.2-29.14-16.22-39.15c-10-10.03-23.85-16.23-39.14-16.23 c-15.29,0-29.14,6.2-39.15,16.22C12.27,32.3,6.07,46.15,6.07,61.44C6.07,73.82,10.13,85.25,16.99,94.47L16.99,94.47L16.99,94.47z"></path></g></svg>
    </div>
    <div class="Name">
      <p>Admin</p>
    </div>
  </center>
    </div>
  <script>
    const bouton = document.getElementById('boutonProfil');
    const profilCard = document.getElementById('profilCard');

    bouton.addEventListener('click', () => {
      if (profilCard.style.display === 'none') {
        profilCard.style.display = 'block';
      } else {
        profilCard.style.display = 'none';
      }
    });
  </script>

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
                'X-CSRF-Token': document.querySelector('input[name="_token"]').value
            },
            body: formData
        });

        if (!response.ok) {
            console.error("Erreur de réponse :", response.statusText);
            resultDiv.innerHTML = `<p>Erreur de récupération des données.</p>`;
            return;
        }

        const data = await response.json();
        console.log("Données reçues :", data); // Vérifiez que les données sont bien reçues ici

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
} else {
    resultDiv.innerHTML = `<p>Aucune donnée à afficher.</p>`;
}

    } catch (error) {
        console.error("Erreur de requête :", error);
        resultDiv.innerHTML = `<p>Une erreur s'est produite lors de la récupération des données.</p>`;
    }
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
                        <td>{{$livreur->cin}}</td>
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
