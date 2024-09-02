<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CompanyFactory extends Factory
{
    protected $model = \App\Models\Company::class;

    public function definition()
    {
        return [
            'nom' => $this->faker->company,
            'ubicacio' => $this->faker->address,
            'descripcio' => $this->faker->text,
            'observacions' => $this->faker->text,
            'responsable' => $this->faker->name,
'nif' => $this->faker->regexify('[A-Z]{2}[0-9]{8}'),
            'color' => $this->faker->safeHexColor,
            'logo' => $this->faker->imageUrl(100, 100),
        ];
    }
}
