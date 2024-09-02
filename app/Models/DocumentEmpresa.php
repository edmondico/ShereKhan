<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DocumentEmpresa extends Model
{
    use HasFactory;

    protected $table = 'documents_empresa'; // Asegúrate de que el nombre de la tabla es correcto.

    protected $fillable = [
        'id_contrata',
        'nom_document',
        'vigencia',
        'data_expedicio',
        'siglas',
        'estat',
        'descripcio',
        'observacions',
    ];
}
