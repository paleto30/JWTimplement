<?php

namespace Database\Factories;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

class EscribeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $publicDay = $this->faker->dateTimeBetween('-10 years', 'now');
        return [
            'id_libro' => rand(1,300),
            'id_escritor' => rand(1, 30),
            'anio' => Carbon::instance($publicDay)->format('Y-m-d'),
        ];
    }
}
