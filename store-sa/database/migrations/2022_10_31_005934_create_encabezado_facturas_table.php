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
            $table->string("Serie",500)->unique();
            $table->date("FechaCompra");
            $table->decimal("Total");

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
