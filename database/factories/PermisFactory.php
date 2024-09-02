<?php

namespace Database\Factories;

use App\Models\Permis;
use Illuminate\Database\Eloquent\Factories\Factory;

class PermisFactory extends Factory
{
    protected $model = Permis::class;

    public function definition()
    {
        return [
            'nom' => $this->faker->word,
            'descripcio' => $this->faker->sentence,
        ];
    }
}
