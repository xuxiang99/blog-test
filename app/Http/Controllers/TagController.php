<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Article;
use \App\Tag;
use \App\ArticleTag;

class TagController extends Controller
{
    public function index(Tag $tag)
    {
    	// 标签信息
    	$tag = $tag->where('id', $tag->id)->withCount('articles')->first();
    	//标签所属文章
    	$articles = $tag->articles()->orderBy('created_at', 'desc')->take(10)->get();
    	// 当前用户未投稿文章
    	$myArticlesIds = Article::where('user_id', \Auth::id())->orderBy('created_at', 'desc')->pluck('id')->toArray();
    	$tagArticlesIds = ArticleTag::where('tag_id', $tag->id)->orderBy('created_at', 'desc')->pluck('article_id')->toArray();
    	$myArticles = Article::orderBy('created_at', 'desc')->findOrFail(array_diff($myArticlesIds, $tagArticlesIds));
    	return view('tag.index', compact('tag', 'articles', 'myArticles'));
    }

    public function submit(Tag $tag)
    {
    	$this->validate(request(), [
    		'post_ids' => 'required|array'
    	]);
    	$post_ids = request('post_ids');
    	$tag_id = $tag->id;
    	$data = array();
    	foreach ($post_ids as $k => $v) {
			$data[$k]['article_id'] = $v;
			$data[$k]['tag_id']     = $tag_id;
			$data[$k]['created_at'] = date('Y-m-d H:i:s');
			$data[$k]['updated_at'] = date('Y-m-d H:i:s');
    	}
    	ArticleTag::insert($data);
    	return back();
    }
}
