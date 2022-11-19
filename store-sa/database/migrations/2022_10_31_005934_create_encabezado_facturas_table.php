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
        Schema::create('encabezado_facturas', function (Blueprint $table) {
            $table->id();
            $table->date("FechaCompra");
            $table->decimal("Total");
            $table->string("NombreCompleto", 250);
            $table->string("DireccionEnvio", 300);
            $table->bigInteger("Telefono");
            $table->bigInteger("NIT");
            
            $table->foreignId("IDDepartamento")->constrained("departamentos");
            $table->foreignId("IDTipoEnvio")->constrained("tipo_envios");
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
        Schema::dropIfExists('encabezado_facturas');
    }
};
