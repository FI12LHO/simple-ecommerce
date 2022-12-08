<?php
namespace Utils;

use Exception;
use Illuminate\Support\Facades\Crypt; 

class Token {
    function __construct() {}

    static function encrypt(Array $array) {
        try {
            $date = date("h.i.s.a.y.m.d");
            $encryptString = "now:$date%&%";
            $i = 1;

            foreach ($array as $key => $value) {
                $encryptString .= "$key:$value";

                if($i < count($array)) {
                    $encryptString .= '%&%';
                }

                $i++;
            }

            return Crypt::encryptString($encryptString);
        
        } catch (Exception $e) {
            return '';
        
        }
    }

    static function desencrypt(String $string) {
        try {
            $encryptString = Crypt::decryptString($string);
            $desencryptArray = array();

            foreach (explode('%&%', $encryptString) as $array) {
                $key = isset(explode(':', $array)[0]) ? explode(':', $array)[0] : null;
                $value = isset(explode(':', $array)[1]) ? explode(':', $array)[1] : '';

                if ($key == 'now') {
                    continue;
                }
                
                $desencryptArray[$key] = $value;
            }
            
            return $desencryptArray;
        
        } catch (Exception $e){
            return '';
            
        }        
    }
}