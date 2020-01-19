<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
	// 黑名单
	protected $guarded = [];

    protected $casts = array('created_at' => 'created_at','updated_at'=>'updated_at');

    public function user()
    {
    	return $this->belongsTo('App\User');
    }

    public function comments()
    {
    	return $this->hasMany(\App\Comment::class)->orderBy('created_at', 'desc');
    }

    public function zan($user_id)
    {
        return $this->hasOne('App\Zan')->where('user_id', $user_id);
    }

    public function zans()
    {
    	return $this->hasMany('App\Zan');
    }

    public function tags()
    {
        return $this->belongsToMany('App\Tag', 'article_tags', 'article_id', 'tag_id');
    }

    public function getArticles()
    {
        return $this->orderBy('created_at', 'desc')->withCount('comments', 'zans')->paginate(5);
    }

    public function getSearchArticles()
    {
        return $this->where('title', 'like', "%" . session('search') . "%")->orWhere('content', 'like', "%" . session('search') . "%")->orderBy('created_at', 'desc')->withCount('comments', 'zans')->paginate(5);
    }
}
