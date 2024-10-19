<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class ClientController extends Controller
{
        // Affiche le formulaire de connexion
        public function showDash()
        {
            return view('client.dashboard');
        }

}
