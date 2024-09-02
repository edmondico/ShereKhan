<?php

namespace Database\Factories;

use App\Models\UsuariPermis;
use App\Models\User;
use App\Models\Permis;
use Illuminate\Database\Eloquent\Factories\Factory;

class UsuariPermisFactory extends Factory
{
    protected $model = UsuariPermis::class;

    public function definition()
    {
        return [
            'id_usuari' => User::factory(),
            'id_permis' => Permis::factory(),
        ];
    }
}
