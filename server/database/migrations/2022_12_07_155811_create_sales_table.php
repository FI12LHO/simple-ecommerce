<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sales', function (Blueprint $table) {
            $table -> string('id') -> primary();
            $table -> string('id_user');
            $table -> string('id_product');
            $table -> double('final_price');
            $table -> string('purchase_link') -> nullable();
            $table -> enum('status', ['success', 'process', 'fail']);
            $table -> timestamps();

            $table -> foreign('id_user') 
                -> references('id') -> on('users');
                
            $table -> foreign('id_product') 
                -> references('id') -> on('products');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sales');
    }
}
