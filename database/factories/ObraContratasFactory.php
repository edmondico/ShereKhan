<?php

namespace Database\Factories;

use App\Models\ObraContratas;
use App\Models\Obra;
use App\Models\Contrata;
use Illuminate\Database\Eloquent\Factories\Factory;

class ObraContratasFactory extends Factory
{
    protected $model = ObraContratas::class;

    public function definition()
    {
        return [
            'id_obra' => Obra::factory(),
            'id_contrata' => Contrata::factory(),
        ];
    }
}
