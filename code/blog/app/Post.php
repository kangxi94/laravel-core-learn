<?php
/**
 * Created by PhpStorm.
 * User: mac
 * Date: 2019-01-09
 * Time: 15:42
 */

namespace App;
use Laravel\Scout\Searchable;

class Post extends Model {

    use Searchable;

    public function searchableAs()
    {
        return 'post';
    }

    public function toSearchableArray()
    {
        return [
            'title' => $this->title,
            'body' => $this->body,
        ];
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title', 'body', 'user_id', 'category_id',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class,'category_id','id');
    }

    public function user()
    {
        return $this->belongsTo(User::class,'user_id','id');
    }

    public function topics()
    {
        return $this->belongsToMany(Topic::class)->withTimestamps();
    }

    public function zans()
    {
        return $this->hasMany(Zan::class,'post_id','id');
    }

    // 是否点赞
    public function is_zan()
    {
        return !!$this->zans()->where('user_id', Auth()->user()->id)->count();
    }

    /*
     * 可以显示的文章
     */
    public function scopeAviable($query)
    {
        return $query->whereIn('status', [1]);
    }

    /**
     * 一篇文章有多个评论
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    /**
     * 获取这篇文章的评论以parent_id来分组
     * @return static
     */
    public function getComments()
    {
        return $this->comments()->with('owner')->get()->groupBy('parent_id');
    }

}