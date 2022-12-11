<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table -> string('id') -> primary();
            $table -> string('name');
            $table -> string('email') -> unique();
            $table -> string('password');
            $table -> string('address') -> nullable();
            $table -> string('district') -> nullable();
            $table -> integer('number') -> nullable();
            $table -> string('CEP', 7) -> nullable();
            $table -> string('phone') -> nullable();
            $table -> string('CPF', 11) -> uniqid();
            $table -> timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
