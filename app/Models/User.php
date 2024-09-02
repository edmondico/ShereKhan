<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'username', // Asegúrate de incluir el campo username
        'email',
        'password',
        'internal_external', // Para indicar si es Interno o Externo
        'user_type', // Tipo de Usuario (Admin, Contrata, Trabajador, etc.)
        'permissions', // Permisos en formato JSON
        'locale', // Idioma preferido del usuario
        'theme', // Tema preferido del usuario
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'permissions' => 'array', // Si los permisos se guardan como JSON
    ];
}
