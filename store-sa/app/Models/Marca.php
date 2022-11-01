<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Marca extends Model
{
    use HasFactory;
    protected $table = "marcas";
    protected $fillable = [
        'Nombre',
        'Email',
        'Telefono',
    ];
    public function producto()
    {
        return $this->hasMany(productos::class, "IDProducto");
    }
}
