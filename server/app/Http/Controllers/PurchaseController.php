<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use MercadoPago\Item;
use MercadoPago\Preference;
use MercadoPago\SDK;

class PurchaseController extends Controller
{
    public $preference;
    public $items = array();
    
    public function create(Request $request) {
        $mercadoPagoSDK = new SDK();
        $mercadoPagoSDK -> setAccessToken($_ENV['ACCESS_TOKEN_MERCADO_PAGO']);

        $this -> createItem('Headset Gamer TGT Diver', 1, 250, '12');

        $this -> definePreference();
        
        return $this -> getPurchaseLink();
    }

    private function createItem($title, $quantity, $unit_price, $id) {
        $store = new Item();
        $store -> id = $id;
        $store -> title = $title;
        $store -> quantity = $quantity;
        $store -> unit_price = (double) $unit_price;

        array_push($this -> items, $store);
    }

    private function definePreference() {
        $this -> preference = new Preference();
        $this -> preference -> items = $this -> items;
    }

    private function getPurchaseLink() {
        $this -> preference -> save();
        return json_encode(['link' => $this -> preference -> sandbox_init_point]);
    }
}
