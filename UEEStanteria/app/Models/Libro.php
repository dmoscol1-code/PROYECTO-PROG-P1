<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Libro extends Model
{
    use HasFactory;

    protected $fillable = [
        'titulo',
        'autor',
        'descripcion',
        'editorial',
        'categoria',
        'anio_publicacion',
        'isbn',
        'paginas',
        'idioma',
        'inventario',
        'precio',
        'edicion',
    ];

    public function prestamos()
    {
        return $this->hasMany(Prestamo::class);
    }
}
