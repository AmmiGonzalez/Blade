<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Empleado extends Model
{
    use HasFactory;
    protected $table = "empleados";

    protected $fillable = [
        'Nombre',
        'Edad',
        'Telefono',
        'Direccion',
        'DPI',
        'IDUsuario',
    ];

    public function user()
    {
        return $this->hasOne(User::class, "IDUsuario");
    }
}
