<?php
/**
 * Created by PhpStorm.
 * User: mac
 * Date: 2019-01-15
 * Time: 11:25
 */

namespace App\Service;



use App\Repository\CommentRepository;

class CommentService {

    protected $commentRepository;

    /**
     * CommentService constructor.
     * @param $commentRepository
     */
    public function __construct(CommentRepository $commentRepository)
    {
        $this->commentRepository = $commentRepository;
    }

    public function findCommentByParentId($parent_id)
    {
        return $this->commentRepository->findCommentByParentId($parent_id);
    }

    // 创建评论
    public function createComment($post, $params)
    {
        return $post->comments()->create($params);
    }


    public function getNewComments($length)
    {
        return $this->commentRepository->getNewComments($length);
    }


}