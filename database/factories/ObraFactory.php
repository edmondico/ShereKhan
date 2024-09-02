<?php

namespace Database\Factories;

use App\Models\Obra;
use Illuminate\Database\Eloquent\Factories\Factory;

class ObraFactory extends Factory
{
    protected $model = Obra::class;

    public function definition()
    {
        return [
            'nom' => $this->faker->company,
            'descripcio' => $this->faker->sentence,
            'ubicacio' => $this->faker->address,
            'data_inici' => $this->faker->date(),
            'data_fi' => $this->faker->date(),
            'presupost' => $this->faker->randomFloat(2, 10000, 500000),
        ];
    }
}
