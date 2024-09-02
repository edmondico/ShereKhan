<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TreballadorObra extends Model
{
    use HasFactory;
    protected $table = 'treballadors_obra'; // Asegúrate de que coincide con la tabla en la base de datos.

    protected $fillable = [
        'id_obra',
        'id_treballador',
        'funcion',
        'data_entrada_obra',
    ];
}
