<?php

namespace App\Models;

use Exception;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;
    protected $table = "productos";
    protected $fillable = [
        'NoSerie',
        'Nombre',
        'Descripcion',
        'Caracteristicas',
        'Precio',
        'Descuento',
        'PathImagen',
        'IDMarca',
        'IDCategoria'
    ];
    
    public function marca()
    {
        return $this->belongsTo(Marca::class, "IDMarca");
    }
    
    public function categoria()
    {
        return $this->belongsTo(categorias::class, "IDCategoria");
    }

    public function distribucion()
    {
        return $this->hasMany(Distribucion::class,"IDProducto");
    }

    public function sucursalProductos()
    {
        return $this->hasMany(SucursalProducto::class, "IDProducto");
    }
}
