<?php
namespace Utils;

use Illuminate\Support\Facades\Crypt; 

class Token {
    function __construct() {}

    static function encrypt(Array $array) {
        $encryptString = '';
        $i = 1;

        foreach ($array as $key => $value) {
            $encryptString .= "$key:$value";

            if($i < count($array)) {
                $encryptString .= '-';
            }

            $i++;
        }

        return Crypt::encryptString($encryptString);
    }

    static function desencrypt(String $string) {
        $encryptString = Crypt::decryptString($string);
        $desencryptArray = array();
        
        foreach (explode('-', $encryptString) as $array) {
            $key = isset(explode(':', $array)[0]) ? explode(':', $array)[0] : null;
            $value = isset(explode(':', $array)[1]) ? explode(':', $array)[1] : '';

            $desencryptArray[$key] = $value;
        }

        return $desencryptArray;
    }
}