<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ObraContrata extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_obra',
        'id_contrata',
    ];
}
