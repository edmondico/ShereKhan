<?php

namespace Database\Factories;

use App\Models\Treballador;
use App\Models\Riscos;
use Illuminate\Database\Eloquent\Factories\Factory;

class DocumentRiscTreballadorFactory extends Factory
{
    protected $model = \App\Models\DocumentRiscTreballador::class;

    public function definition()
    {
        return [
            'id_treballador' => Treballador::factory(),
            'id_risc' => Riscos::factory(),
            'nom_document' => $this->faker->word,
            'vigencia' => $this->faker->date(),
            'data_expedicio' => $this->faker->date(),
            'observacions' => $this->faker->sentence,
            'descripcio' => $this->faker->paragraph,
            'siglas' => $this->faker->lexify('???'),
            'estat' => $this->faker->randomElement(['valid', 'expired', 'pending']),
        ];
    }
}
