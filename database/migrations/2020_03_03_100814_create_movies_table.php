<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMoviesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('movies', function (Blueprint $table) {
            $table->bigIncrements('episode_id');
            $table->string('title');
            $table->longText('opening_crawl');
            $table->string('director');
            $table->integer('characters_count');
            $table->integer('species_count');
            $table->integer('planets_count');
            $table->string('producer');
            $table->date('release_date');
            $table->dateTimeTz('created');
            $table->dateTimeTz('edited');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('movies');
    }
}
