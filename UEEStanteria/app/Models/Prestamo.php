<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prestamo extends Model
{
    use HasFactory;

    protected $fillable = [
        'libro_id',
        'prestado_a',
        'fecha_prestamo',
        'fecha_devolucion',
    ];

    protected $casts = [
        'fecha_prestamo' => 'date',
        'fecha_devolucion' => 'date',
    ];

    public function libro()
    {
        return $this->belongsTo(Libro::class);
    }
}
