<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use PDOException;
use Utils\Token;

class UserController extends Controller
{
    public function login(Request $request) {
        $request -> validate([
            'email' => ['required', 'string', 'email'],
            'password' => ['required', 'string'],
        ]);

        $user = User::login($request -> post('email'), $request -> post('password'));
        
        if (empty($user)) {
            return response() -> json([
                'Error' => 'User not found or does not exist'
            ], 406);
        }

        $token = Token::encrypt([
            'id' => $user -> id,
            'name' => $user -> name,
            'email' => $user -> email,
        ]);

        if (empty($token)) {
            return response() -> json([
                'Error' => 'Internal Server Error'
            ], 500);
        }

        return response() -> json(['token_access' => $token], 200);
    }

    public function register(Request $request) {
        $request -> validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'password' => ['required', 'string', 'min:6'],
            'address' => ['required', 'string'],
            'district' => ['required', 'string'],
            'number' => ['required', 'numeric'],
            'CEP' => ['required', 'string'],
            'CPF' => ['required', 'string'],
        ]);

        try {
            User::create([
                'id' => Str::random(8),
                'name' => $request -> post('name'),
                'email' => $request -> post('email'),
                'password' => $request -> post('password'),
                'address' =>  $request -> post('address'),
                'district' => $request -> post('district'),
                'number' => $request -> post('number'),
                'CEP' => $request -> post('CEP'),
                'CPF' => $request -> post('CPF'),
            ]);

        } catch (PDOException $e) {
            return response() -> json([
                'Error' => 'Internal Server Error'
            ], 500);
        }
        
        return response() -> json([
            'status' => 'success',
            'message' => 'User created successfully',
        ], 200);
    }

    public function me(Request $request) {
        $token_access = Token::desencrypt($request -> header('Token-Access'));
        
        return response() -> json(
            User::where($token_access) -> first()
        );
    }
}
