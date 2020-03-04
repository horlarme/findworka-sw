<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @method static self|Model firstOrCreate(array $array)
 * @method static Builder latest(string $string)
 * @method static Builder whereEpisodeId(string $episode)
 * @property mixed id
 * @property mixed episode_id
 * @property mixed characters_count
 * @property mixed title
 * @property mixed opening_crawl
 * @property mixed director
 * @property mixed species_count
 * @property mixed planets_count
 * @property mixed producer
 * @property mixed release_date
 * @property mixed created
 * @property mixed edited
 * @property Comment[] $comment
 */
class Movie extends Model
{
    public $timestamps = false;
    protected $guarded = ['episode_id'];
    protected $primaryKey = 'episode_id';

    /**
     * @param Http\Interfaces\Film $film
     * @return Movie|Model
     */
    public static function makeFromRequest(Http\Interfaces\Film $film)
    {
        return self::firstOrCreate([
            'episode_id' => $film->episode_id,
            'title' => $film->title,
            'opening_crawl' => $film->opening_crawl,
            'director' => $film->director,
            'producer' => $film->producer,
            'release_date' => $film->release_date,
            'characters_count' => count($film->characters),
            'planets_count' => count($film->planets),
            'species_count' => count($film->species),
            'created' => Carbon::make($film->created),
            'edited' => Carbon::make($film->edited),
        ]);
    }

    /**
     * @return HasMany|Comment[]
     */
    public function comment()
    {
        return $this->hasMany(Comment::class, 'movie_episode_id', 'episode_id');
    }

    public function characters()
    {
        return $this->belongsTo(Character::class, 'movie_episode_id', 'episode_id');
    }
}
