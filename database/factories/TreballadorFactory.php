<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Contrata;

class TreballadorFactory extends Factory
{
    protected $model = \App\Models\Treballador::class;

    public function definition()
    {
        return [
            'id_contrata' => Contrata::factory(),
            'nom' => $this->faker->firstName,
            'cognom' => $this->faker->lastName,
            'dni' => $this->faker->unique()->regexify('[0-9]{8}[A-Z]'),
            'mail' => $this->faker->safeEmail,
            'telefon' => $this->faker->phoneNumber,
            'data_naixement' => $this->faker->date(),
            'genere' => $this->faker->randomElement(['M', 'F']),
            'id_responsable' => null,
            'telefon_empresa' => $this->faker->phoneNumber,
        ];
    }
}
