<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ContrataFactory extends Factory
{
    protected $model = \App\Models\Contrata::class;

    public function definition()
    {
        return [
            'nom_fiscal' => $this->faker->company,
            'nom_comercial' => $this->faker->companySuffix,
            'direccio' => $this->faker->address,
            'mail' => $this->faker->companyEmail,
            'telefon' => $this->faker->phoneNumber,
            'responsable' => $this->faker->name,
'cif' => $this->faker->regexify('[A-Z]{2}[0-9]{8}'),
            'logo' => $this->faker->imageUrl(100, 100),
            'color' => $this->faker->safeHexColor,
            'descripcio_activitat' => $this->faker->text,
            'codi_postal' => $this->faker->postcode,
            'poblacion' => $this->faker->city,
            'provincia' => $this->faker->state,
        ];
    }
}
