<?php
/**
 * Created by PhpStorm.
 * User: mac
 * Date: 2019-01-09
 * Time: 15:40
 */

namespace App;
use App\Post;

class Category extends Model {

    protected $table = 'categorys';

    protected $fillable = [
        'name'
    ];

    public function posts()
    {
        return $this->hasMany(Post::class,'category_id','id');
    }

}