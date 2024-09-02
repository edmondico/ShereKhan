<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LlegitTreballadorRiscos extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_obra_document_risc_lloc',
        'id_treballador',
        'estat',
    ];
}
