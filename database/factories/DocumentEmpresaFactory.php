<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class DocumentEmpresaFactory extends Factory
{
    protected $model = \App\Models\DocumentEmpresa::class;

    public function definition()
    {
        return [
            'id_contrata' => \App\Models\Contrata::factory(),
            'nom_document' => $this->faker->word,
            'vigencia' => $this->faker->date,
            'data_expedicio' => $this->faker->date,
            'siglas' => strtoupper($this->faker->lexify('???')),
            'estat' => $this->faker->randomElement(['valid', 'expired', 'pending']),
            'descripcio' => $this->faker->sentence,
            'observacions' => $this->faker->paragraph,
        ];
    }
}
