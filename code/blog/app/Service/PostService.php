<?php
/**
 * Created by PhpStorm.
 * User: mac
 * Date: 2019-01-10
 * Time: 09:50
 */

namespace App\Service;

use App\Repository\PostRepository;
use App\Repository\CategoryRepository;
use App\Repository\ZanRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class PostService {

    protected $postRepositoy;
    protected $categoryRepositoy;
    protected $zanRepository;

    /**
     * PostService constructor.
     * @param $postRepositoy
     * @param $categoryRepositoy
     */
    public function __construct(PostRepository $postRepositoy,CategoryRepository $categoryRepositoy, ZanRepository $zanRepository)
    {
        $this->postRepositoy = $postRepositoy;
        $this->categoryRepositoy = $categoryRepositoy;
        $this->zanRepository = $zanRepository;
    }

    /**
     * @param $category
     * @return mixed
     */
    public function getPosts($category)
    {
        Cache::flush();
        // 获取category_id 0 代表所以文章
        $category_id = $category->exists ? $category->id : 0;
        $posts_key = 'posts:' . $category_id.':'. request()->get('page');
        $posts = Cache::get($posts_key);
        if ( !$posts) {
            if($category_id){
                $posts = $this->categoryRepositoy->getPostsByCategory($category);
            }else{
                $posts = $this->postRepositoy->getPosts();
            }
            Cache::put($posts_key, $posts, 1);
        }
        return $posts;
    }

    public function createPost($params)
    {
        // 增加用户文章数
        Auth::user()->increment('post_count');
        return $this->postRepositoy->createPost($params);
    }

    public function updatePost($post, $params)
    {
        return $this->postRepositoy->update($post, $params);
    }

    public function deletePost($post)
    {
        $post->update(['is_aviable' => -1]);
        return Auth::user()->decrement('post_count');
    }

    public function search($query)
    {
        return $this->postRepositoy->search($query);
    }


    // 点赞
    public function doZan($zan_post)
    {
        $zan = $this->zanRepository->createZan($zan_post);
        return $zan_post->zans()->save($zan);
    }

    // 取消赞
    public function doUnZan($zan_post)
    {
        $zan = $this->zanRepository->getZan($zan_post);
        return $zan_post->zans()->delete($zan);
    }

}