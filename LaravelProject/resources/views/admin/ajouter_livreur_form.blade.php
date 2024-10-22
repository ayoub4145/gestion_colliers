<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Ajouter un livreur</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        body {
            background-color: #f8f9fa;
        }
        form {
            margin: 50px auto;
            max-width: 600px;
            padding: 20px;
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        table {
            width: 100%;
        }
        th, td {
            padding: 10px;
            text-align: left;
        }
        th {
            width: 30%;
            color: #495057;
            font-weight: bold;
        }
        td {
            width: 70%;
        }
        input[type="submit"] {
            width: 100%;
            padding: 10px;
            background-color: #0d6efd;
            border: none;
            color: white;
            border-radius: 5px;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #0056b3;
        }
        .form-check {
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <form action="{{route('livreur')}}" method="POST">
        @csrf
        <table class="table">
            <tr>
                <th>Nom</th>
                <td><input type="text" class="form-control" name="nom" required></td>
            </tr>
            <tr>
                <th>Prénom</th>
                <td><input type="text" class="form-control" name="prenom" required></td>
            </tr>
            <tr>
                <th>Adresse</th>
                <td><input type="text" class="form-control" name="adresse"></td>
            </tr>
            <tr>
                <th>Statut</th>
                <td>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="statut" value="disponible" checked> Disponible
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="statut" value="occupe"> Occupé
                    </div>
                </td>
            </tr>
            <tr>
                <th>Email</th>
                <td><input type="email" class="form-control" name="email"></td>
            </tr>
            <tr>
                <th>Téléphone</th>
                <td><input type="tel" class="form-control" name="telephone" required></td>
            </tr>
        </table>
        <input type="submit" value="Ajouter" class="btn btn-primary">
    </form>
</body>
</html>
