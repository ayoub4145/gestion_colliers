<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class RegisterController extends Controller
{
    public function showRegisterForm(){
        return view('Register');
    }
    public function register(Request $request){
        
    }
}
