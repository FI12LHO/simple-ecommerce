<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use MercadoPago\Item;
use MercadoPago\Preference;
use MercadoPago\SDK;
use Ramsey\Uuid\Type\Integer;

class Purchase extends Model
{
    use HasFactory;

    // private static SDK $sdk;
    private static Preference $preference;
    private static Array $items;

    function __construct() {
        // Definindo access token do mercado pago
        \MercadoPago\SDK::setAccessToken($_ENV['ACCESS_TOKEN_MERCADO_PAGO']);

        // Instanciando class Preference
        Purchase::$preference = new \MercadoPago\Preference();
    }

    static function createItem(String $title, Int $quantity, Float $unit_price, String $id) {
        $item = new Item();
        $item -> id = $id;
        $item -> title = $title;
        $item -> quantity = $quantity;
        $item -> unit_price = (double) $unit_price;

        Purchase::$items[] = $item;
    }

    static function definePreference(Array $options = []) {
       Purchase::$preference -> items = Purchase::$items;
    }

    static function getPurchaseLink() {
        Purchase::$preference -> save();
        $link = ['link' => Purchase::$preference -> sandbox_init_point];

        return $link;
    }
}
