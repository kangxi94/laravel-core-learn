<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Zan extends Model
{
    protected $fillable = [
        'post_id', 'user_id'
    ];
}
