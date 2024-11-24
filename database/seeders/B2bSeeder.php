<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class B2bSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create('fr_FR');

        for ($i = 0; $i < 1000; $i++) {
            DB::table('b2b')->insert([
                'raison_social' => $faker->company(),
                'dirigeant_name' => $faker->lastName(),
                'dirigeant_prenom' => $faker->firstName(),
                'address' => $faker->streetAddress(),
                'postal_code' => $faker->postcode(),
                'ville' => $faker->city(),
                'phone' => $faker->unique()->phoneNumber(),
                'gsm' => $faker->phoneNumber(),
                'pays_id' => 1,
            ]);
        }
    }
}
