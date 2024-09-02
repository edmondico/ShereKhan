<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UsuariPermis extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_usuari',
        'id_permis',
    ];
}
