<?php

namespace Database\Factories;

use App\Models\B2b;
use Illuminate\Database\Eloquent\Factories\Factory;

class B2bFactory extends Factory
{
    protected $model = B2b::class;

    public function definition(): array
    {
        $data = [
            'raison_social' => $this->faker->company(),
            'dirigeant_name' => $this->faker->lastName(),
            'dirigeant_prenom' => $this->faker->firstName(),
            'address' => $this->faker->streetAddress(),
            'postal_code' => $this->faker->postcode(),
            'ville' => $this->faker->city(),
            'phone' => $this->faker->unique()->phoneNumber(),
            'gsm' => $this->faker->phoneNumber(),
            'pays_id' => rand(1, 4),
        ];

        // Génération de 1000 colonnes supplémentaires
        for ($i = 1; $i <= 3000; $i++) {
            $data["column_{$i}"] = $this->faker->word();
        }

        return $data;
    }
}
