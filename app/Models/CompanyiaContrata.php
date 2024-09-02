<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanyiaContrata extends Model
{
    use HasFactory;

    protected $table = 'companyia_contrata'; // Asegúrate de que coincide con la tabla en la base de datos.

    protected $fillable = [
        'id_companyia',
        'id_contrata',
    ];
}
