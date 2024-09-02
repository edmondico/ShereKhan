<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class TipusDocFactory extends Factory
{
    protected $model = \App\Models\TipusDoc::class;

    public function definition()
    {
        return [
            'nom' => $this->faker->word,
            'descripcio' => $this->faker->sentence,
            'siglas' => strtoupper($this->faker->lexify('???')),
            'notas' => $this->faker->paragraph,
        ];
    }
}
