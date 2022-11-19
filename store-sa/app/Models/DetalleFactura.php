<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetalleFactura extends Model
{
    use HasFactory;
    protected $table = "detalle_facturas";
    protected $fillable = [
        "Subtotal",
        "Cantidad",
        "IDEncabezadoFactura",
        "IDSucursalProducto"
    ];

    public function encabezado_sucursal()
    {
        return $this->belongsTo(encabezado_facturas::class, 'IDEncabezadoFactura');
        return $this->belongsTo(sucursal_productos::class, 'IDSucursalProducto');
    }
}
