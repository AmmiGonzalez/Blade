<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('distribucions', function (Blueprint $table) {
            $table->id();
            $table->date("Fecha");

            $table->foreignId("IDProducto")->constrained("productos");
            $table->foreignId("IDDistribuidor")->constrained("distribuidores");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('distribucions');
    }
};
