<?php

namespace App\Http\Middleware;

use App\Movie;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class MovieMiddleware
{
    /**
     * Check the url and get the requested movie episode id
     * and verify that it is valid before proceeding with
     * the request.
     *
     * @param Request $request
     * @param Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if ($episode = $request->route('episode')) {
            $movie = Movie::whereEpisodeId($episode)->first();
            if ($movie) {
                $GLOBALS['movie'] = $movie;
            } else {
                return sendResponse([
                    'type' => 'Not Found',
                    'message' => 'Episode Not Found'
                ], 'error', Response::HTTP_NOT_FOUND);
            }
        } else {
            sendResponse([
                'type' => 'Invalid Route Middleware',
                'message' => 'Current route doesn\' support "Movie Middleware"'
            ], 'error', Response::HTTP_CONFLICT);
        }
        return $next($request);
    }
}
