<?php

namespace App;

class Topic extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name'];

    public function posts()
    {
        return $this->belongsToMany(Post::class)->withTimestamps();
    }

}
