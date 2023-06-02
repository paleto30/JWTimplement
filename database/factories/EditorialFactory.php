<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class EditorialFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'nombre_editorial' => $this->faker->name(),
            'pais_editorial' =>  $this->faker->country()             
        ];
    }
}
