<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ObraContrataFactory extends Factory
{
    protected $model = \App\Models\ObraContrata::class;

    public function definition()
    {
        return [
            'id_obra' => \App\Models\Obra::factory(),
            'id_contrata' => \App\Models\Contrata::factory(),
        ];
    }
}
