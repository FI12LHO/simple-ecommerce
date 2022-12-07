<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Product extends Model
{
    use HasFactory;

    protected $table = 'products';

    protected $primaryKey = 'id';

    protected $fillable = [
        'title',
        'quantity',
        'description',
        'imageURL',
        'unit_price',
    ];

    static function getAllProducts() {
        $data = DB::table('products') -> orderByDesc('created_at') -> get();

        return $data;
    }

    static function updateProduct(string $id, array $data) {
        DB::table('products') -> where('id', '=', $id) -> update($data);
    }
}
