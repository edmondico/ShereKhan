<?php

// App\Models\Obra.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Obra extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom', 'descripcio', 'ubicacio', 'data_inici', 'data_fi', 'presupost', 'estado', 'cliente', 'responsable_id'
    ];

    // Relación con el modelo User
    public function companies()
    {
        return $this->belongsToMany(Company::class);
    }

    public function riscos()
    {
        return $this->belongsToMany(Riscos::class);
    }

    public function contratas()
    {
        return $this->belongsToMany(Contrata::class)->withPivot('treballadors');
    }

    public function documents()
    {
        return $this->hasMany(DocumentacioPersonalTreballador::class);
    }
}
