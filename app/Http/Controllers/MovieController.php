<?php

namespace App\Http\Controllers;

use App\Http\Resources\MovieResource;
use App\Movie;

class MovieController extends Controller
{
    public function fetch()
    {
        return tryc(function () {
            $movies = Movie::oldest('release_date')->get();
            return sendResponse($movies->map(fn(Movie $movie) => new MovieResource($movie)));
        });
    }

    public function single()
    {
        return tryc(function () {
            return sendResponse(
                new MovieResource(getMovie())
            );
        });
    }
}
