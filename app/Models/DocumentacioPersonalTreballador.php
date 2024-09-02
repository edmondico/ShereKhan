<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DocumentacioPersonalTreballador extends Model
{
    use HasFactory;

    protected $table = 'documentacio_personal_treballador';

    protected $fillable = [
        'id_treballador',
        'nom_document',
        'data_expedicio',
        'tipus_document',
        'descripcio',
        'observacions',
        'estat',
    ];

    public function treballador()
    {
        return $this->belongsTo(Treballador::class, 'id_treballador');
    }
}
