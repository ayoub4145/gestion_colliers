<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Liste des livreurs</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
    <button type="button">Profil</button>
        <h1 style="text-align:center;color:gray">Bonjour Admin</h1>
        <hr>
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
                        <td><a href="">Modifier</a> <a href="">Supprimer</a></td>
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
