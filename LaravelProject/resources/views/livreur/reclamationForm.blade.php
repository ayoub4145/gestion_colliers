<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Réclamation</title>

    <!-- SweetAlert CSS & JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Style CSS -->
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            background-color: #f4f4f9;
            color: #333;
            line-height: 1.6;
        }

        h1 {
            text-align: center;
            color: #4CAF50;
        }

        p {
            text-align: center;
            margin-bottom: 30px;
        }

        form {
            max-width: 400px;
            margin: 20px auto;
            padding: 20px;
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        label {
            font-weight: bold;
            display: block;
            margin-bottom: 8px;
        }

        input[type="text"],
        textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-sizing: border-box;
            font-size: 14px;
        }

        input[type="radio"] {
            margin-right: 8px;
        }

        button {
            width: 100%;
            padding: 10px;
            background: #4CAF50;
            color: #fff;
            border: none;
            border-radius: 4px;
            font-size: 16px;
            cursor: pointer;
        }

        button:hover {
            background: #45a049;
        }

        .error-list {
            color: #e74c3c;
            background: #fdecea;
            padding: 10px;
            border: 1px solid #e74c3c;
            border-radius: 4px;
            margin-bottom: 20px;
        }

        ul {
            list-style: none;
            padding: 0;
        }
    </style>
</head>
<body>
    <h1>Réclamation</h1>
    <p>Indiquez si le colis a été livré ou non, ainsi que le problème rencontré.</p>

    @if ($errors->any())
        <div class="error-list">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form id="reclamationForm" action="{{ route('reclamer.store') }}" method="POST">
        @csrf
        <label for="colis_id">Colis sélectionné :</label>
        <input type="text" id="colis_id" name="colis_id" value="{{ $colis->id ?? '' }}" readonly>

        <label for="status">Le colis a-t-il été livré ?</label><br>
        <input type="radio" id="oui" name="status" value="oui" required>
        <label for="oui">Oui</label><br>
        <input type="radio" id="non" name="status" value="non">
        <label for="non">Non</label>

        <label for="probleme">Décrivez le problème (si non livré) :</label>
        <textarea id="probleme" name="probleme" rows="4" cols="40" placeholder="Détails du problème"></textarea>

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
