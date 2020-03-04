<?php

namespace App\Http\Resources;

use App\Comment;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CommentResource extends JsonResource
{
    /**
     * @var Comment
     */
    public $resource;

    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->resource->id,
            'comment' => $this->resource->comment,
            'ip' => $this->resource->user_ip,
            'created_at' => $this->resource->created_at
        ];
    }
}
