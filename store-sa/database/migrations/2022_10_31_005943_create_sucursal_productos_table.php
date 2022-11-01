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
        Schema::create('sucursal_productos', function (Blueprint $table) {
            $table->id();
            $table->integer("Existencia");

            $table->foreignId("IDSucursal")->constrained("sucursals");
            $table->foreignId("IDProducto")->constrained("productos");
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
        Schema::dropIfExists('sucursal_productos');
    }
};
