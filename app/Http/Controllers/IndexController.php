<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Article;

class IndexController extends Controller
{
    public function index(Article $article)
    {
    	if (request()->path() == '/') {
    		if (session('search') != 'Search...') {
    			session(['search' => 'Search...']);
    		}
    	}
    	 
    	if (request()->isMethod('post') || request()->path() == 'search') {
	    	$text = request('text');
	    	if ($text != '' || session('search') == 'Search...') {
	    		session(['search' => $text]);
	    	}
	    	$articles = $article->getSearchArticles();
    	} else {
    		$articles = $article->getArticles();
    	}
    	// \Redis::Set('s',222);
    	cache(['key' => 111], 10);
    	// dd(cache('key'));
    	return view('index.index', compact('articles'));
    }
}
