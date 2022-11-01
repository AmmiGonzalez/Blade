<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;
    protected $table = "clientes";
    protected $fillable = [
        "Nombre",
        "Edad",
        "Telefono",
        "Direccion",
        "DPI",
        "NIT"
    ];

    public function encabezado_factura()
    {
        return $this->hasMany(encabezado_facturas::class);
        return $this->belongsTo(users::class, 'IDUsuario');
    }
}
