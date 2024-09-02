<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PermisRol extends Model
{
    use HasFactory;

    protected $table = 'permis_rol';

    protected $fillable = [
        'id_permis',
        'id_rol',
    ];
}
