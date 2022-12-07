<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Product;


class ProductController extends Controller
{
    public function index() {
        return json_encode(Product::getAllProducts());
    }

    public function create(Request $request) {
        $request -> validate([
            'title' => ['required', 'max:255'],
            'quantity' => ['required', 'integer'],
            'description' => ['required', 'max:255'],
            'imageURL' => ['required'],
            'unit_price' => ['required', 'numeric'],
        ]);

        $post = $request -> post();

        $product = [
            'id' => Str::random(8),
            'title' => $post['title'],
            'quantity' => $post['quantity'],
            'description' => $post['description'],
            'imageURL' => $post['imageURL'],
            'unit_price' => $post['unit_price'],
        ];

        Product::create($product);

        return json_encode(['id' => $product['id']]);
    }

    public function udpdate(String $id, Request $request) {
        $request -> validate([
            'title' => ['required', 'max:255'],
            'quantity' => ['required', 'integer'],
            'description' => ['required', 'max:255'],
            'imageURL' => ['required'],
            'unit_price' => ['required', 'numeric'],
        ]);

        $post = $request -> post();

        $product = [
            'title' => $post['title'],
            'quantity' => $post['quantity'],
            'description' => $post['description'],
            'imageURL' => $post['imageURL'],
            'unit_price' => $post['unit_price'],
        ];

        Product::updateProduct($id, $product);

        return json_encode(Product::find(['id' => $id]));
    }

    public function destroy(String $id, Request $request) {
        
    }
}
