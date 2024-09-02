<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DocumentRiscLlocTreballador extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_document_risc_lloc',
        'id_treballador',
    ];
}
