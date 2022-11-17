<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Distribucion extends Model
{
    use HasFactory;
    protected $table = "distribucions";
    protected $fillable = [
        "Fecha",
        "IDProducto",
        "IDDistribuidor"
    ];

    public function productos_distribuidores()
    {
        return $this->belongsTo(productos::class, 'IDProducto');
        return $this->belongsTo(distribuidores::class, 'IDDistribuidor');
    }
}
