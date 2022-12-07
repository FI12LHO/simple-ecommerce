<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function login(Request $request) {
        $credentials = $request -> only(['email', 'password']);

        return $credentials;
    }

    public function register(Request $request) {
        
    }

    public function me(Request $request) {
        
    }
}
