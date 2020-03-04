<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property mixed comment
 * @property mixed id
 * @property mixed movie_episode_id
 * @property mixed user_ip
 * @property mixed $created_at
 */
class Comment extends Model
{
    protected $guarded = [];
}
