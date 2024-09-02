<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Obra;
use App\Models\Treballador;

class TreballadorObraFactory extends Factory
{
    protected $model = \App\Models\TreballadorObra::class;

    public function definition()
    {
        return [
            'id_obra' => Obra::factory(),
            'id_treballador' => Treballador::factory(),
            'funcion' => $this->faker->jobTitle,
            'data_entrada_obra' => $this->faker->date(),
        ];
    }
}
