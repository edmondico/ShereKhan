<?php

namespace Database\Factories;

use App\Models\UsuariRol;
use App\Models\Rol;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class UsuariRolFactory extends Factory
{
    protected $model = UsuariRol::class;

    public function definition()
    {
        return [
            'id_usuari' => User::factory(),
            'id_rol' => Rol::factory(),
        ];
    }
}
