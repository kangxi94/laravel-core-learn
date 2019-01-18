<?php
/**
 * Created by PhpStorm.
 * User: mac
 * Date: 2019-01-10
 * Time: 16:28
 */

namespace App\Http\Controllers;
use App\Events\SearchEvent;
use App\Post;
use App\Service\CategoryService;
use App\Service\PostService;
use App\Service\TopicService;
use App\Service\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redis;

class PostController extends Controller {

    protected $categoryService;
    protected $postService;
    protected $userService;
    protected $topicService;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(PostService $postService, CategoryService $categoryService, UserService $userService, TopicService $topicService)
    {
        $this->middleware('auth',['except' => ['index','search']]);
        $this->categoryService = $categoryService;
        $this->postService = $postService;
        $this->userService = $userService;
        $this->topicService = $topicService;
    }

    public function show(Post $post)
    {
        $post = $post->load('user');
        $Parsedown = new \Parsedown();
        $post->body = $Parsedown->text($post->body);
        // 增加统计量
        $post->increment('watch_count');
        // 其他文章
        $other_posts = $this->userService->getPostsByUser($post->user,$post->id);


        // 评论列表
        $comments = $post->getComments();
        if(!empty($comments[''])){
            $comments['root'] = $comments[''];
            unset($comments['']);
        }else {
            $comments = [];
        }

        return view('post/show', compact('post','other_posts', 'comments'));
    }

    public function create()
    {
        // 获取categorys
        $categorys = $this->categoryService->getCategorys();

        return view('post.create',compact('categorys'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'category_id' => 'required',
            'title' => 'required|max:255|min:4',
            'body' => 'required|min:6',
        ]);

        // 转换topic
        $topics = $this->topicService->normalizeTopic($request->get('topics'));
        $params = array_merge(request(['category_id', 'title', 'body']), ['user_id' => Auth::id()]);
        $post = $this->postService->createPost($params);
        // 添加关联
        $post->topics()->attach($topics);

        return redirect("/post/{$post->id}");
    }

    public function edit(Post $post)
    {
        // 获取categorys
        $categorys = $this->categoryService->getCategorys();

        return view('post/edit', compact('post','categorys'));
    }

    public function update(Request $request,Post $post)
    {
        $this->validate($request, [
            'category_id' => 'required',
            'title' => 'required|max:255|min:4',
            'body' => 'required|min:6',
        ]);

        // 策略验证
        $this->authorize('update', $post);

        $params = request(['title', 'body']);
        $this->postService->updatePost($post, $params);

        return redirect("/post/{$post->id}");
    }

    public function delete(Post $post)
    {
        // 策略验证
        $this->authorize('update', $post);
        $this->postService->deletePost($post);
        return redirect("/");
    }

    public function search()
    {
        $this->validate(request(),[
            'query' => 'required',
        ]);

        $query = request('query');
        $posts = $this->postService->search($query);

        // 触发搜索事件
        event(new SearchEvent($query));

        $rank_list = Redis::zrevrange('rank-list',0,-1,'withscores');
        return view('post/search',compact('posts','query', 'rank_list'));
    }

}