<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Exceptions\ValidationException;
use App\Http\Resources\CommentResource;
use Illuminate\Support\Facades\Validator;

class CommentController extends Controller
{
    public function comment()
    {
        return tryc(function () {
            /**
             * We don't have to worry about catching
             * exception since they will be taken care of
             * by tryc helper function.
             */
            $this->validateCreateRequest();
            $movie = getMovie();
            $comment = $movie->comment()->create([
                'comment' => request('comment'),
                'user_ip' => request()->ip()
            ]);

            return sendResponse(
                new CommentResource($comment)
            );
        });
    }

    /**
     * @throws ValidationException
     */
    private function validateCreateRequest()
    {
        $instance = Validator::make(request()->only('comment'), [
            'comment' => 'required|min:1|max:500'
        ]);

        if ($instance->fails()) throw new ValidationException($instance);
    }

    public function list()
    {
        return tryc(function () {
            $comments = getMovie()->comment()->latest()->get();

            if($comments->isEmpty()){
                return sendResponse([
                    'type' => 'No Data',
                    'message' => 'No Comment Available'
                ], 'error');
            }

            return sendResponse(
                $comments->map(fn(Comment $comment) => new CommentResource($comment))
            );
        });
    }
}
