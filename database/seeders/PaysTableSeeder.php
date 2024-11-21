<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Pays;

class PaysTableSeeder extends Seeder
{
    public function run()
    {
        $pays = [
            ['name' => 'France', 'indicatif' => 33],
            ['name' => 'Belgique', 'indicatif' => 32],
            ['name' => 'Maroc', 'indicatif' => 212],
            ['name' => 'Suisse', 'indicatif' => 41],
        ];
        Pays::insert($pays);
    }
}
