<?php

use App\Movie;
use Illuminate\Database\Seeder;

class CharacterSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Movie::all()
            ->map(function (Movie $movie) {
                // fetch characters
                $character = [];
                $movie->characters()->firstOrCreate([
                    'name' => $character['name']
                ]);
            });
    }
}
