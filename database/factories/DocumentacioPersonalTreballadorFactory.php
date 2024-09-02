<?php

namespace Database\Factories;

use App\Models\DocumentacioPersonalTreballador;
use App\Models\Treballador;
use Illuminate\Database\Eloquent\Factories\Factory;

class DocumentacioPersonalTreballadorFactory extends Factory
{
    protected $model = DocumentacioPersonalTreballador::class;

    public function definition()
    {
        return [
            'id_treballador' => Treballador::factory(),
            'nom_document' => $this->faker->word,
            'data_expedicio' => $this->faker->date(),
            'tipus_document' => $this->faker->randomElement(['identificacio', 'formacio', 'contracte', 'altre']),
            'descripcio' => $this->faker->sentence,
            'observacions' => $this->faker->sentence,
            'estat' => $this->faker->randomElement(['pendent', 'validat', 'rebutjat']),
        ];
    }
}
