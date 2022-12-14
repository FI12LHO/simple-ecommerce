<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Foundation\Auth\User as Authenticatable;
use PDOException;

class User extends Authenticatable
{

    protected $table = 'users';

    protected $primaryKey = 'id';

    protected $fillable = [
        'id',
        'name',
        'email',
        'password',
        'address',
        'district',
        'number',
        'CEP',
        'phone',
        'CPF'
    ];

    protected $hidden = [
        'password'
    ];

    static function login(String $email, String $password) {
        try {
            $user = DB::table('users') 
                -> where('email', '=', $email) 
                -> where('password', '=', $password) 
                -> first();

            return $user;

        } catch (PDOException $e) {
            return '';
            
        }   
    }

    static function signup($data) {
        $user = $data;
        $user['id'] =  Str::random(8);

        try {
            DB::table('users') -> insert($user);
            return $user;

        } catch (PDOException $error) {
            return $error -> getMessage();
            
        }
    }
}
