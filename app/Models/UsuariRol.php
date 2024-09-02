<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UsuariRol extends Model
{
    use HasFactory;

    protected $table = 'usuari_rol';

    protected $fillable = [
        'id_usuari',
        'id_rol',
    ];
}
