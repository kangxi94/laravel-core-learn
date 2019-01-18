<?php
/**
 * Created by PhpStorm.
 * User: mac
 * Date: 2019-01-15
 * Time: 11:26
 */

namespace App\Repository;


use App\Comment;

class CommentRepository {


    public function findCommentByParentId($parent_id)
    {
        return Comment::findOrFail($parent_id);
    }

    public function getNewComments($length)
    {
        return Comment::orderBy('created_at', 'desc')->with('owner','post')->take($length)->get();
    }

}