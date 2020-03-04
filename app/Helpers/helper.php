<?php

use App\Exceptions\ValidationException;
use App\Movie;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

/**
 * A function to help limit how many times we write try catch blocks
 *
 *
 * @param Closure $callable
 * @return JsonResponse|mixed|object
 */
function tryc(Closure $callable)
{
    try {
        return $callable();
    } catch (ValidationException $exception) {
        return sendResponse([
            'type' => 'Validation Error',
            'errors' => $exception->getErrors()
        ], Response::HTTP_PARTIAL_CONTENT);
    } catch (Exception $exception) {
        return sendResponse([
            'type' => 'Internal Server Error'
        ], 'error', 501);
    }
}

/**
 * Helps prevent writing long code when sending response
 * @param $message
 * @param string $status
 * @param int $code
 * @return JsonResponse|object
 */
function sendResponse($message, $status = 'success', $code = 200)
{
    return response()
        ->json([
            'status' => $status,
            'result' => $message
        ])
        ->header("Access-Control-Allow-Origin", "*")
        ->header("Access-Control-Allow-Methods", "PUT, POST")
        ->setStatusCode($code);
}

/**
 * Help with getting store variable storing
 * the requested movie from the request url by middleware
 *
 * @return Movie
 */
function getMovie()
{
    return $GLOBALS['movie'];
}
