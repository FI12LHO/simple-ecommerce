<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    use HasFactory;

    protected $table = 'sales';

    protected $primaryKey = 'id';

    protected $fillable = [
        'id',
        'id_user',
        'id_product',
        'final_price',
        'status',
        'purchase_link',
    ];
}
