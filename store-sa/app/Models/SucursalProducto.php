<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SucursalProducto extends Model
{
    use HasFactory;
    protected $table = "sucursal_productos";
    protected $fillable = [
        'Existencia',
        'IDSucursal',
        'IDProducto',
    ];
    
    public function sucursal()
    {
        return $this->belongsTo(Sucursal::class, "IDSucursal");
    }

    public function producto()
    {
        return $this->belongsTo(productos::class, "IDProducto");
    }

    public function detalle_facturas()
    {
        return $this->hasMany(DetalleFactura::class, "IDSucursalProducto");
    }
}
