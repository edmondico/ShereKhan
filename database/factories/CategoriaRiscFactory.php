<?php

namespace Database\Factories;

use App\Models\CategoriaRisc;
use Illuminate\Database\Eloquent\Factories\Factory;

class CategoriaRiscFactory extends Factory
{
    protected $model = CategoriaRisc::class;

    public function definition()
    {
        return [
            'nom' => $this->faker->word,
            'descripcio' => $this->faker->sentence,
        ];
    }
}
