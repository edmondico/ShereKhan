<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permis extends Model
{
    use HasFactory;

    protected $table = 'permisos';

    protected $fillable = [
        'nom',
        'descripcio',
    ];
}
