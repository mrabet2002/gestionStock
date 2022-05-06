<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class MarqueFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            "id_user" => $this->faker->numberBetween($min = 1, $max = 10),
            "libele" => $this->faker->sentence($nbWords = 5, $variableNbWords = true),
            "descripiton" =>$this->faker->paragraph($nbSentences = 3, $variableNbSentences = true),
        ];
    }
}
