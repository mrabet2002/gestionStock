<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ProduitFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            "id_categorie" => $this->faker->numberBetween($min = 1, $max = 10),
            "id_marque" => $this->faker->numberBetween($min = 1, $max = 10),
            "id_fournisseur" => $this->faker->numberBetween($min = 1, $max = 4),
            "id_user" => 1,
            "libele" => $this->faker->sentence($nbWords = 5, $variableNbWords = true),
            "code_barre" => $this->faker->regexify('[0-9]{6}'),
            "description" => $this->faker->paragraph,
            "min_stock" => $this->faker->numberBetween($min = 1, $max = 150),
            "prix_initial" => $this->faker->numberBetween($min = 100, $max = 999),
            "poids" => $this->faker->numberBetween($min = 1, $max = 150),
        ];
    }
}
