<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EncabezadoFactura extends Model
{
    use HasFactory;
    protected $table = "encabezado_facturas";
    protected $fillable = [
        'FechaCompra',
        'Total',
        'NombreCompleto',
        'DireccionEnvio',
        'Telefono',
        'NIT',
        'IDTipoEnvio',
        'IDDepartamento'
    ];
    public function detalle_clientes()
    {
        return $this->hasMany(detalle_facturas::class, "IDDetalle");
        return $this->belongsTo(tipo_envios::class);
        return $this->belongsTo(clientes::class);
        return $this->belongsTo(empleados::class);
    }
}
