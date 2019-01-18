<?php
/**
 * Created by PhpStorm.
 * User: mac
 * Date: 2019-01-10
 * Time: 09:53
 */

namespace App\Repository;
use App\Category;


class CategoryRepository {

    /**
     * @return mixed
     */
    public function getCategorys()
    {
        return Category::orderBy('created_at', 'desc')->get();
    }


    public function getPostsByCategory($category)
    {
        return $category->posts()->with('user')->paginate(10);
    }

}