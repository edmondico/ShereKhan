<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DocumentRiscTreballador extends Model
{
    use HasFactory;

    protected $table = 'documents_riscos_treballadors'; // Asegúrate de que coincide con la tabla en la base de datos.

    protected $fillable = [
        'id_treballador',
        'id_risc',
        'nom_document',
        'vigencia',
        'data_expedicio',
        'observacions',
        'descripcio',
        'siglas',
        'estat',
    ];
}
