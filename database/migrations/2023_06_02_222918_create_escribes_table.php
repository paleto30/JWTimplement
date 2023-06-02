<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEscribesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('escribes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_libro');
            $table->unsignedBigInteger('id_escritor');
            $table->date('anio');

            $table->timestamps();

            $table->foreign('id_libro')->references('id')->on('libros');
            $table->foreign('id_escritor')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('escribes');
    }
}
