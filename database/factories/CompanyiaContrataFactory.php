<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Company;
use App\Models\Contrata;

class CompanyiaContrataFactory extends Factory
{
    protected $model = \App\Models\CompanyiaContrata::class;

    public function definition()
    {
        return [
            'id_companyia' => Company::factory(),
            'id_contrata' => Contrata::factory(),
        ];
    }
}
