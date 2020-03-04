<?php

namespace App\Http\Resources;

use App\Movie;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MovieResource extends JsonResource
{
    /**
     * @var Movie
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
            'id' => $this->resource->episode_id,
            'title' => $this->resource->title,
            'opening_crawl' => $this->resource->opening_crawl,
            'director' => $this->resource->director,
            'characters_count' => $this->resource->characters_count,
            'species_count' => $this->resource->species_count,
            'planets_count' => $this->resource->planets_count,
            'producer' => $this->resource->producer,
            'release_date' => $this->resource->release_date,
            'created' => $this->resource->created,
            'edited' => $this->resource->edited,
            'comment_count' => $this->resource->comment()->count()
        ];
    }
}
