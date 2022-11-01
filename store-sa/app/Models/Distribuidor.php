<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Distribuidor extends Model
{
    use HasFactory;
    protected $table = "distribuidores";
    protected $fillable = [
        "Nombre",
        "Direccion",
        "Email",
        "Telefono"
    ];

    public function distribucion()
    {
        return $this->hasMany(distribucions::class);
    }
}
