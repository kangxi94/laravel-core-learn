<?php
/**
 * Created by PhpStorm.
 * User: mac
 * Date: 2019-01-09
 * Time: 15:57
 */

namespace App\Http\Controllers;


use App\Service\CategoryService;
use App\Category;
use App\Service\CommentService;
use App\Service\PostService;

class IndexController extends Controller {

    protected $postService;
    protected $categoryService;
    protected $commentService;

    /**
     * IndexController constructor.
     * @param $postService
     * @param $categoryService
     */
    public function __construct(PostService $postService,CategoryService $categoryService, CommentService $commentService)
    {
        $this->postService = $postService;
        $this->categoryService = $categoryService;
        $this->commentService = $commentService;
    }


    public function index(Category $category)
    {
        // 获取categorys
        $categorys = $this->categoryService->getCategorys();

        // 获取posts
        $posts = $this->postService->getPosts($category);

        // 获取最新评论
        $comments = $this->commentService->getNewComments(10);


        return view('index',compact('category','categorys','posts', 'comments'));
    }





}