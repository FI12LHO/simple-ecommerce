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
            $table -> string('id_user') -> unsigned();
            $table -> string('id_product') -> unsigned();
            $table -> double('price');
            $table -> enum('status', ['success', 'fail']);
            $table -> timestamps();

            $table -> foreign('id_user') 
                -> references('id') -> on('users') 
                -> onUpdate('cascade') -> onDelete('cascade');
                
            $table -> foreign('id_product') 
                -> references('id') -> on('products') 
                -> onUpdate('cascade') -> onDelete('cascade');
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
