<?php

namespace App\Http\Interfaces;

class Film
{
    public string $title;
    public string $episode_id;
    public string $opening_crawl;
    public string $director;
    public string $producer;
    public string $release_date;
    public array $characters;
    public array $planets;
    public array $starships;
    public array $vehicles;
    public array $species;
    public string $created;
    public string $edited;
    public string $url;

    /**
     * Make a Film class from an array
     *
     * @param $data
     * @return self
     */
    public static function make($data)
    {
        $instance = new self();

        collect($data)
            ->each(fn($value, string $key) => $instance->{$key} = $value);

        return $instance;
    }
}
