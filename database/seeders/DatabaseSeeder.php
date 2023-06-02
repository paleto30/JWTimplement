<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Categoria;
use App\Models\Editorial;
use App\Models\Escribe;
use App\Models\Libro;
use App\Models\User;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        //User::factory(30)->create();
        //Categoria::factory(15)->create();
        //Editorial::factory(20)->create();
        //Libro::factory(300)->create();
        Escribe::factory(300)->create();    
        
    }
}
