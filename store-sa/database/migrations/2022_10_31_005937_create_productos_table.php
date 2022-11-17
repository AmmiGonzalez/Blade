<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('productos', function (Blueprint $table) {
            $table->id();
            $table->string("NoSerie",500)->unique();
            $table->string("Nombre",250);
            $table->string("Descripcion", 500);
            $table->string("Caracteristicas",500);
            $table->decimal("Precio");
            $table->integer("Descuento");
            $table->string("PathImagen", 1000);

            $table->foreignId("IDMarca")->constrained("marcas");
            $table->foreignId("IDCategoria")->constrained("categorias");
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
        Schema::dropIfExists('productos');
    }
};
