<?php

namespace Database\Factories;

use App\Models\Riscos;
use Illuminate\Database\Eloquent\Factories\Factory;

class RiscosFactory extends Factory
{
    protected $model = Riscos::class;

    public function definition()
    {
        return [
            'nom' => $this->faker->word,
            'descripcio' => $this->faker->sentence,
            'epi' => $this->faker->boolean,
            'observacions' => $this->faker->sentence,
            'grau_de_risc' => $this->faker->randomElement(['baix', 'mitja', 'alt']),
            'requisits' => $this->faker->sentence,
        ];
    }
}
