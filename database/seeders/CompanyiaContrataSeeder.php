<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\CompanyiaContrata;

class CompanyiaContrataSeeder extends Seeder
{
    public function run()
    {
        CompanyiaContrata::factory(10)->create();
    }
}
