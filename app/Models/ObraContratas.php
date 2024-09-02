<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ObraContratas extends Model
{
    use HasFactory;

    protected $table = 'obra_contratas';

    protected $fillable = [
        'id_obra',
        'id_contrata',
    ];

    public function obra()
    {
        return $this->belongsTo(Obra::class, 'id_obra');
    }

    public function contrata()
    {
        return $this->belongsTo(Contrata::class, 'id_contrata');
    }
}
