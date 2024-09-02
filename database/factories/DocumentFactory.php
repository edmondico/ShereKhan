<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class DocumentFactory extends Factory
{
    protected $model = \App\Models\Document::class;

    public function definition()
    {
        return [
            'nom' => $this->faker->word,
            'descripcio' => $this->faker->sentence,
            'siglas' => strtoupper($this->faker->lexify('???')),
            'ruta' => $this->faker->url,
            'vigencia' => $this->faker->date,
        ];
    }
}
