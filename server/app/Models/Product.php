<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use PDOException;

class Product extends Model
{
    use HasFactory;

    protected $table = 'products';

    protected $primaryKey = 'id';

    protected $fillable = [
        'id',
        'title',
        'quantity',
        'description',
        'imageURL',
        'unit_price',
    ];

    static function getProductWithId(String $id) {
        try {
            $data = DB::table('products') -> where('id', '=', $id) -> first();

            return $data;

        } catch (PDOException) {
            return '';   
            
        }
    }

    static function getAllProducts() {
        $data = DB::table('products') -> orderByDesc('created_at') -> get();

        return $data;
    }

    static function updateProduct(string $id, array $data) {
        try {
            $product = Product::getProductWithId($id);
            
            if (empty($product)) {
                return false;
            }

            DB::table('products') -> where('id', '=', $id) -> update($data);

            return true;

        } catch (PDOException $e) {
            return false;

        }
    }
}
