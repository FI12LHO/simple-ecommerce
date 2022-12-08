<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::create([
            'id' => '#123',
            'name' => 'John Doe',
            'email' => 'john-doe@mail.com',
            'password' => '123456789',
            'address' => 'Street one',
            'district' => 'District central',
            'number' => 42, 
            'CEP' => '1234567',
            'CPF' => '00000000000'
        ]);

        \App\Models\Product::create([
            'id' => '#321',
            'title' => 'Produto 1',
            'quantity' => 1,
            'description' => 'Um otimo produto dependendo do seu uso.',
            'imageURL' => 'www.meu-site.com/product-1.png',
            'unit_price' => (double) 75.00,
        ]);

        \App\Models\Product::create([
            'id' => Str::random(8),
            'title' => 'Produto 2',
            'quantity' => 1,
            'description' => 'Um otimo produto dependendo do seu uso.',
            'imageURL' => 'www.meu-site.com/product-2.png',
            'unit_price' => (double) 75.00,
        ]);

        \App\Models\Product::create([
            'id' => Str::random(8),
            'title' => 'Produto 3',
            'quantity' => 1,
            'description' => 'Um otimo produto dependendo do seu uso.',
            'imageURL' => 'www.meu-site.com/product-3.png',
            'unit_price' => (double) 75.00,
        ]);

        \App\Models\Sale::create([
            'id' => Str::random(8),
            'id_user' => '#123',
            'id_product' => '#321',
            'final_price' => (double) 75.00,
            'status' => 'success'
        ]);
    }
}
