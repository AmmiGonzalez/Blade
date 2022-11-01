<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoEnvio extends Model
{
    use HasFactory;
    protected $table = "tipo_envios";
    protected $fillable = [
        'Nombre'
    ];
    public function encabezado_factura()
    {
        return $this->hasMany(encabezado_facturas::class, "IDEncabezadoFactura");
    }
}
