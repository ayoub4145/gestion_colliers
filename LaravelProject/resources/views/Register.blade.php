<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/register.css') }}"/>
    <title>Inscription</title>
    <style>
        /* General page styles */
body {
    font-family: Arial, sans-serif;
    background-color: #f4f7fc;
    margin: 0;
    padding: 0;
}

/* Top bar and Nav bar styling */
x-TopBar, x-NavBar {
    /* Add your styling for top bar and navbar */
}

/* Form container */
.form {
    max-width: 500px;
    margin: 50px auto;
    padding: 20px;
    background-color: #fff;
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

/* Title */
.title {
    text-align: center;
    font-size: 24px;
    font-weight: bold;
    margin-bottom: 20px;
}

/* Input styles */
.input {
    width: 100%;
    padding: 12px 15px;
    margin: 10px 0;
    border: 1px solid #ddd;
    border-radius: 4px;
    box-sizing: border-box;
    font-size: 16px;
    background-color: #f9f9f9;
}

.input:focus {
    outline: none;
    border-color: #007bff;
    background-color: #fff;
}

/* Label styling */
label {
    display: block;
    margin: 10px 0;
    font-size: 14px;
    color: #333;
}

/* Focused input label */
input:focus + span {
    color: #007bff;
}

/* Placeholder styling */
input::placeholder {
    color: #888;
}

/* Button styles */
.submit {
    width: 100%;
    padding: 12px;
    background-color: #007bff;
    color: white;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    font-size: 16px;
}

.submit:hover {
    background-color: #0056b3;
}

/* Sign-in message */
.signin {
    text-align: center;
    margin-top: 20px;
    font-size: 14px;
}

.signin a {
    color: #007bff;
    text-decoration: none;
}

.signin a:hover {
    text-decoration: underline;
}

/* Responsive styles */
@media (max-width: 600px) {
    .form {
        padding: 15px;
        margin: 20px;
    }

    .title {
        font-size: 20px;
    }

    .input {
        font-size: 14px;
    }

    .submit {
        font-size: 14px;
    }
}
</style>
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
        <input class="input" type="text" name="ville" placeholder="" required="">
        <span>Ville</span>
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
