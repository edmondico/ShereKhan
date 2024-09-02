<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ObraDocumentRiscLloc extends Model
{
    use HasFactory;

    protected $table = 'obra_documents_risc_lloc'; // Asegúrate de que coincide con la tabla en la base de datos.

    protected $fillable = [
        'id_obra',
        'id_document_risc_lloc',
    ];
}
