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
    <p class="title">Register </p>
    <p class="message">Signup now and get full access to our app. </p>
        <div class="flex">
        <label>
            <input class="input" type="text" placeholder="" required="">
            <span>Firstname</span>
        </label>

        <label>
            <input class="input" type="text" placeholder="" required="">
            <span>Lastname</span>
        </label>
    </div>

    <label>
        <input class="input" type="email" placeholder="" required="">
        <span>Email</span>
    </label>

    <label>
        <input class="input" type="password" placeholder="" required="">
        <span>Password</span>
    </label>
    <label>
        <input class="input" type="password" placeholder="" required="">
        <span>Confirm password</span>
    </label>
    <button class="submit">Submit</button>
    <p class="signin">Already have an acount ? <a href="{{ route('login') }}">Signin</a> </p>
</form>
</body>
</html>
