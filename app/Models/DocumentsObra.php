<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DocumentsObra extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_obra',
        'id_document',
        'id_treballador',
        'estat',
    ];

    public function obra()
    {
        return $this->belongsTo(Obra::class, 'id_obra');
    }

    public function treballador()
    {
        return $this->belongsTo(Treballador::class, 'id_treballador');
    }
}
