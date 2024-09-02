<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Riscos extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom',
        'descripcio',
        'epi',
        'observacions',
        'grau_de_risc',
        'requisits',
    ];
    protected $casts = [
        'epi' => 'boolean',
    ];
}
