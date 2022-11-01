<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sucursal extends Model
{
    use HasFactory;
    protected $table = "sucursals";
    protected $fillable = [
        'Direccion',
        'Nombre',
        'Ubicacion',
    ];
    public function sucursal_municipio()
    {
        return $this->hasMany(sucursal_productos::class, "IDSucursalProducto");
        return $this->belongsTo(municipios::class);
    }
}
