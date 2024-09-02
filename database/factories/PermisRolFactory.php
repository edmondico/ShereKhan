<?php

namespace Database\Factories;

use App\Models\PermisRol;
use App\Models\Rol;
use App\Models\Permis;
use Illuminate\Database\Eloquent\Factories\Factory;

class PermisRolFactory extends Factory
{
    protected $model = PermisRol::class;

    public function definition()
    {
        return [
            'id_permis' => Permis::factory(),
            'id_rol' => Rol::factory(),
        ];
    }
}
