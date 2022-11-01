<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;
    protected $table = "productos";
    protected $fillable = [
        'Nombre',
        'Descripcion',
        'Caracteristicas',
        'Precio',
        'Descuento%'
    ];
    public function sucursalProductos_distribucion()
    {
        return $this->hasMany(sucursal_productos::class, "IDSucursalProducto");
        return $this->hasMany(distribucions::class,"IDDistribucion");
        return $this->belongsTo(marcas::class);
        return $this->belongsTo(categorias::class);
    }
}
