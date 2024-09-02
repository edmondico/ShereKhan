<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom',
        'ubicacio',
        'descripcio',
        'nif',
        'color',
        'logo',
    ];
    public function obras()
    {
        return $this->belongsToMany(Obra::class, 'company_obra');
    }
}
