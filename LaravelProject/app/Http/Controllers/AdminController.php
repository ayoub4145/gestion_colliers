<?php

namespace App\Http\Controllers;
use App\Models\Admin;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class AdminController extends Controller
{
        // Affiche le formulaire de connexion
        public function showDash()
        {
            return view('admin.dashboard');
        }


}
