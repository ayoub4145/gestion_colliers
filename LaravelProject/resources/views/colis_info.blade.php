<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Détails du Colis</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }
        .container {
            background-color: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 500px;
        }
        h1 {
            text-align: center;
            color: #333;
        }
        p {
            margin: 8px 0;
            font-size: 16px;
            color: #555;
        }
        .button {
            display: flex;
            justify-content: center;
            margin-top: 20px;
        }
        .btn-back {
            background-color: #007bff;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
            font-size: 16px;
        }
        .btn-back:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        @if(isset($colisData))
            <h1>Détails du Colis</h1>
            <p><strong>Numéro de suivi:</strong> {{ $colisData['numero_suivi'] }}</p>
            <p><strong>Description:</strong> {{ $colisData['description'] }}</p>
            <p><strong>Contenu:</strong> {{ $colisData['contenu_colis'] }}</p>
            <p><strong>Statut:</strong> {{ $colisData['statut_colis'] }}</p>
            <p><strong>Poids:</strong> {{ $colisData['poids'] }} kg</p>
            <p><strong>Prix:</strong> {{ $colisData['prix'] }} €</p>
            <p><strong>Expéditeur:</strong> {{ $colisData['expediteur_nom'] }} {{ $colisData['expediteur_prenom'] }}</p>
            <p><strong>Destinataire:</strong> {{ $colisData['destinataire_nom'] }} {{ $colisData['destinataire_prenom'] }}</p>
            <p><strong>Livreur:</strong> {{ $colisData['livreur_nom'] }} {{ $colisData['livreur_prenom'] }}</p>
            <p><strong>Date de livraison:</strong> {{ $colisData['date_livraison'] }}</p>
        @else
            <p>{{ $error }}</p>
        @endif

        <div class="button">
            <button class="btn-back" onclick="history.back()">Retour</button>
        </div>
    </div>
</body>
</html>
