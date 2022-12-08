<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Product;
use PDOException;

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

        $id = Str::random(8);

        try {   
            Product::create([
                'id' => $id,
                'title' => $post['title'],
                'quantity' => $post['quantity'],
                'description' => $post['description'],
                'imageURL' => $post['imageURL'],
                'unit_price' => $post['unit_price'],
            ]);
        
        } catch (PDOException $e) {
            return response() -> json([
                'Error' => 'Internal Server Error'
            ], 500);
        }
        
        return json_encode(['id' => $id]);
    }

    public function update(String $id, Request $request) {
        $request -> validate([
            'title' => ['required', 'max:255'],
            'quantity' => ['required', 'integer'],
            'description' => ['required', 'max:255'],
            'imageURL' => ['required'],
            'unit_price' => ['required', 'numeric'],
        ]);

        $post = $request -> post();

        $data = [
            'title' => $post['title'],
            'quantity' => $post['quantity'],
            'description' => $post['description'],
            'imageURL' => $post['imageURL'],
            'unit_price' => $post['unit_price'],
            'updated_at' => date('Y-m-d H:i:s')
        ];

        $success = Product::updateProduct($id, $data);

        if ($success) {
            return response() -> json([
                'status' => 'success',
                'message' => 'Product updated successfully',
            ], 200);

        } else {
            return response() -> json([
                'Error' => 'Internal Server Error'
            ], 500);

        }
    }

    public function destroy(String $id) {
        try {
            $product = Product::where(['id' => $id]) -> first();

            if (empty($product) || $product == null) {
                return response() -> json([
                    'status' => 'fail',
                    'message' => 'Product not found',
                ], 406);
            }

            $product -> delete();

            return response() -> json([
                'status' => 'success',
                'message' => 'Product deleted successfully',
            ], 200);

        } catch (PDOException $e) {
            return response() -> json([
                'Error' => 'Internal Server Error'
            ], 500);

        }
    }
}
