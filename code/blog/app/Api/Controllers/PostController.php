<?php
/**
 * Created by PhpStorm.
 * User: mac
 * Date: 2019-01-14
 * Time: 17:17
 */

namespace App\Api\Controllers;


use App\Post;
use App\Service\CommentService;
use App\Service\PostService;
use Illuminate\Http\Request;

class PostController extends Controller {

    protected $postService;
    protected $commentService;
    /**
     * PostController constructor.
     * @param $postService
     */
    public function __construct(PostService $postService, CommentService $commentService)
    {
        $this->postService = $postService;
        $this->commentService = $commentService;
    }

    public function isZan(Post $zan_post)
    {
        return response()->json([
            'is_zan' => $zan_post->is_zan()
        ]);
    }

    public function zanOrCancel(Post $zan_post)
    {

        if ($zan_post->is_zan()) {
            $this->postService->doUnZan($zan_post);
            $zan_post->decrement('fav_count');
        }else {
            $this->postService->doZan($zan_post);
            $zan_post->increment('fav_count');
        }

        return response()->json([
            'fav_count' => $zan_post->fav_count,
            'is_zan' => $zan_post->is_zan()
        ]);

    }

    public function comment(Request $request,Post $post)
    {
        $this->validate($request, [
            'body' => 'required|min:2',
        ]);

        if (request('parent_id')) {
            $real_comment = $this->commentService->findCommentByParentId(request('parent_id'));
            $level = $real_comment->level + 1;
            if ($level >= 3) {
                $level = 3;
            }
        }else {
            $level = 0;
        }

        $params = array_merge(request(['parent_id', 'body']),['level' => $level ,'user_id' => \Auth::id()]);
        $comment = $this->commentService->createComment($post,$params);
        $comment = $comment->load('owner');

        return response()->json([
            'reply_block' => $comment,
        ]);

    }


}