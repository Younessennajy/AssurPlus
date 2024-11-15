<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Country;

class CountriesTableSeeder extends Seeder
{
    public function run()
    {
        $countries = [
            ['name' => 'France', 'country_code' => 33],
            ['name' => 'Belgique', 'country_code' => 32],
            ['name' => 'Maroc', 'country_code' => 212],
            ['name' => 'Suisse', 'country_code' => 41],
        ];

        Country::insert($countries);
    }
}
