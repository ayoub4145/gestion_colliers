<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Réclamation</title>

    <!-- SweetAlert CSS & JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Style optionnel -->
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        form {
            max-width: 400px;
            margin: auto;
        }
    </style>
</head>
<body>
    <h1>Réclamation</h1>
    <p>Indiquez si le colis a été livré ou non, ainsi que le problème rencontré.</p>

    <form id="reclamationForm" action="{{ route('reclamation.store') }}" method="POST">
        @csrf
        <label for="colis_id">Colis sélectionné :</label>
        <input type="text" id="colis_id" name="colis_id" value="{{ $colis->id ?? '' }}" readonly>
        <br><br>

        <label for="status">Le colis a-t-il été livré ?</label><br>
        <input type="radio" id="oui" name="status" value="oui" required>
        <label for="oui">Oui</label><br>
        <input type="radio" id="non" name="status" value="non">
        <label for="non">Non</label><br><br>

        <label for="probleme">Décrivez le problème (si non livré) :</label><br>
        <textarea id="probleme" name="probleme" rows="4" cols="40" placeholder="Détails du problème"></textarea>
        <br><br>

        <button type="submit">Envoyer la réclamation</button>
    </form>

    <script>
        document.getElementById('reclamationForm').addEventListener('submit', function(event) {
            event.preventDefault(); // Empêche l'envoi immédiat du formulaire

            const status = document.querySelector('input[name="status"]:checked')?.value;
            const probleme = document.getElementById('probleme').value;

            if (status === 'non' && !probleme.trim()) {
                Swal.fire({
                    icon: 'warning',
                    title: 'Problème requis',
                    text: 'Veuillez décrire le problème si le colis n\'a pas été livré.',
                });
                return;
            }

            Swal.fire({
                icon: 'question',
                title: 'Confirmation',
                text: 'Voulez-vous envoyer cette réclamation ?',
                showCancelButton: true,
                confirmButtonText: 'Oui, envoyer',
                cancelButtonText: 'Annuler',
            }).then((result) => {
                if (result.isConfirmed) {
                    this.submit(); // Envoie le formulaire si l'utilisateur confirme
                }
            });
        });
    </script>
</body>
</html>
