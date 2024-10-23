<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/register.css') }}"/>
    <title>Inscription</title>
</head>
<body>
    <x-TopBar/>
    <x-NavBar/>
<form class="form" method="POST" action="{{ route('register') }}">
    @csrf
    <p class="title">Register </p>
    {{-- <p class="message">Signup now and get full access to our app. </p> --}}
        <div class="flex">
        <label>
            <input class="input" type="text" name="prenom" placeholder="" required="">
            <span>Prénom</span>
        </label>

        <label>
            <input class="input" type="text" name="nom" placeholder="" required="">
            <span>Nom</span>
        </label>
    </div>
    <label>
        <input class="input" type="text" name="adresse" placeholder="" required="">
        <span>Adresse</span>
    </label>
    <label>
        <input class="input" type="text" name="cin" placeholder="" required="">
        <span>CIN</span>
    </label>
    <label>
        <input class="input" type="email" name="email" placeholder="" required="">
        <span>Email</span>
    </label>
    <label>
        <input class="input" type="tel" name="tel" placeholder="" required="">
        <span>Téléphone</span>
    </label>
    <label>
        <input class="input" type="password" name="password" placeholder="" required="">
        <span>Password</span>
    </label>


    <button class="submit">Submit</button>
    <p class="signin">Vous avez déja un compte ? <a href="{{ route('login') }}">Se connecter</a> </p>
</form>
</body>
</html>
