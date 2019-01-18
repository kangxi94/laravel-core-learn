<?php
/**
 * Created by PhpStorm.
 * User: mac
 * Date: 2019-01-10
 * Time: 09:53
 */

namespace App\Repository;
use App\Post;

class PostRepository {

    /**
     * @param $category
     * @return mixed
     */
    public function getPosts()
    {
        return Post::orderBy('created_at', 'desc')->with('user','topics')->paginate(10);
    }

    public function createPost($params)
    {
        return Post::create($params);
    }

    public function updatePost($post, $params)
    {
        return $post->update($params);
    }

    public function search($query)
    {
        return Post::search($query)->paginate(10);
    }

}