<?php

use App\Http\Interfaces\Film;
use App\Movie;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Http;

class MovieSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /**
         * Using a seeder because we wouldn't want to be fetching the film list
         * every time we need the film list and also it increases the speed of the
         * request since we won't be making a third-party request anymore.
         *
         * Note: Whenever this seeder is ran, it does not remove the previous data
         * but instead update and also, there wouldn't be an update since the movie
         * wont be shot again instead there will be a creation of a new film and not
         * updating old ones.
         */

        $request = Http::get('https://swapi.co/api/films/');
        $data = $request->json();

        /** @var Film $film */
        collect($data['results'])
            ->each(fn($film) => Movie::makeFromRequest(Film::make($film)));
    }
}
