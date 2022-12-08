<?php
namespace Utils;

use Exception;
use Illuminate\Support\Facades\Crypt; 

class Token {
    private static Bool $expired = false;

    static function encrypt(Array $array) {
        try {
            $date = date("Y.m.d H+i+s");
            $encryptString = "created:$date%&%";
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

                if ($key == 'created') {
                    Token::validateCreationDate($value, 3);

                    continue;
                }
                
                $desencryptArray[$key] = $value;
            }
            
            return $desencryptArray;
        
        } catch (Exception $e){
            return '';
            
        }        
    }

    private static function validateCreationDate(String $created, int $timeInMinutesToExpire = 5) {
        $created = str_replace('+', ':', str_replace('.', '-', $created));
        $now = date("Y-m-d H:i:s");
        $diff = intval(abs(strtotime($now) - strtotime($created)) / 60);

        if ($diff > $timeInMinutesToExpire || empty($diff)) {
            // O token expirou
            Token::$expired = true;
            return null;
        }

        Token::$expired = false;

        return null;
    }

    static function isExpired() {
        return Token::$expired;
    }
}