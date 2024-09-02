<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contrata extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom_fiscal', 'nom_comercial', 'direccio', 'mail', 'telefon', 'responsable', 'cif', 'logo', 'color', 'descripcio_activitat', 'codi_postal', 'poblacion', 'provincia',
    ];
    public function treballadors()
    {
        return $this->hasMany(Treballador::class, 'id_contrata');
    }
}
