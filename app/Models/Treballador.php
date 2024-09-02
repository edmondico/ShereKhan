<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Treballador extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_contrata',
        'nom',
        'cognom',
        'dni',
        'mail',
        'telefon',
        'data_naixement',
        'genere',
        'id_responsable',
        'telefon_empresa',
    ];

    public function contrata()
    {
        return $this->belongsTo(Contrata::class, 'id_contrata');
    }

    public function responsable()
    {
        return $this->belongsTo(Treballador::class, 'id_responsable');
    }
}
