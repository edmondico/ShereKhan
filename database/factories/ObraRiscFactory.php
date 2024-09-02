<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Obra;
use App\Models\Riscos;

class ObraRiscFactory extends Factory
{
    protected $model = \App\Models\ObraRisc::class;

    public function definition()
    {
        return [
            'id_obra' => Obra::factory(),
            'id_risc' => Riscos::factory(),
        ];
    }
}
