<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Municipio extends Model
{
    use HasFactory;
    protected $table = "municipios";
    protected $fillable = [
        'Nombre'
    ];
    public function sucursal()
    {
        return $this->hasMany(sucursals::class, "IDSucursal");
        return $this->belongsTo(departamentos::class);
    }
}
