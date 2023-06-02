<?php

namespace Database\Factories;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

class LibroFactory extends Factory
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
            'nombre_libro' => $this->faker->name(),
            'numero_paginas' => $this->faker->numberBetween(100,1000),
            'fecha_publicacion' => Carbon::instance($publicDay)->format('Y-m-d'),
            'id_categoria' => rand(1,15),
            'id_editorial' => rand(1,20)
        ];
    }
}
