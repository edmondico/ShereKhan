<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ObraRisc extends Model
{
    use HasFactory;
    protected $table = 'obra_riscos'; // Asegúrate de que coincide con la tabla en la base de datos.

    protected $fillable = [
        'id_obra',
        'id_risc',
    ];
}
