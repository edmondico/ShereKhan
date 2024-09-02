<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserContrata extends Model
{
    use HasFactory;

    protected $table = 'user_contrata';

    protected $fillable = [
        'id_usuari',
        'id_contrata',
    ];

    public function usuari()
    {
        return $this->belongsTo(User::class, 'id_usuari');
    }

    public function contrata()
    {
        return $this->belongsTo(Contrata::class, 'id_contrata');
    }
}
