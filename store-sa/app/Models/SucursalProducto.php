<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SucursalProducto extends Model
{
    use HasFactory;
    protected $table = "sucursal_productos";
    protected $fillable = [
        'Existencia'
    ];
    public function detalle_sucursal_producto()
    {
        return $this->hasMany(detalle_facturas::class, "IDDetalle");
        return $this->belongsTo(sucursals::class);
        return $this->belongsTo(productos::class);
    }
}
