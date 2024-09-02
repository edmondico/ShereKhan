<?php

namespace Database\Factories;

use App\Models\UserContrata;
use App\Models\User;
use App\Models\Contrata;
use Illuminate\Database\Eloquent\Factories\Factory;

class UserContrataFactory extends Factory
{
    protected $model = UserContrata::class;

    public function definition()
    {
        return [
            'id_usuari' => User::factory(),
            'id_contrata' => Contrata::factory(),
        ];
    }
}
