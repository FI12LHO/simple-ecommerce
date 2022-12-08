<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Purchase;
use App\Models\Sale;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use PDOException;

class SaleController extends Controller
{
    public function create(Request $request) {
        $request -> validate([
            'id_user' => ['required', 'string'],
            'id_product' => ['required', 'string'],
            'final_price' => ['required', 'numeric'],
            'status' => ['required', 'string'],
        ]);

        try {
            $product = Product::getProductWithId($request -> post('id_product'));

            if (empty($product)) {
                return response() -> json([
                    'Error' => 'Internal Server Error'
                ], 500);
            }

            $purchase = new Purchase();
            $purchase::createItem(
                $product -> title, $product -> quantity, $product -> unit_price, Str::random((8))
            );
            $purchase::definePreference();
            $link = $purchase::getPurchaseLink()['link'];

            Sale::create([
                'id' => Str::random(8),
                'id_user' => $request -> post('id_user'),
                'id_product' => $request -> post('id_product'),
                'final_price' => $request -> post('final_price'),
                'status' => $request -> post('status'),
                'purchase_link' => $link,
            ]);

            return response() -> json([
                'status' => 'success',
                'message' => 'Sale created successfully',
                'link' => $link,
            ], 200);

        } catch (PDOException $e) {
            echo $e -> getMessage();

            return response() -> json([
                'Error' => 'Internal Server Error'
            ], 500);
        }
    }
}
