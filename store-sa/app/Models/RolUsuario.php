<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RolUsuario extends Model
{
    use HasFactory;
    protected $table = "rol_usuarios";
    protected $fillable = [
        "Nombre",
        "Descripcion"
    ];

    public function users()
    {
        return $this->hasMany(User::class, "IDRol");
    }
}
