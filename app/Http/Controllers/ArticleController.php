<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Article;
use App\Comment;

class ArticleController extends Controller
{
    public function create()
    {
    	return view('article.create');
    }

    public function imageUpload(Request $request)
    {
    	$this->validate(request(),[
    		'image' => 'image'
    	]);
    	$file = $request->file('image');
    	if ($file->isValid()) {
    		$path = $file->store('upload/' . date('Ymd'), 'public');
            return '/storage/' . $path;

            // wangEditor3返回
    		// return array(
	    	// 	'error' => 0,
	    	// 	'data'	=> $path,
	    	// 	'url'	=> '/storage/' . $path
	    	// );
    	}
    	return back();
    }

    public function store()
    {
    	$this->validate(request(), [
			'title'   => 'required|max:100',
			'content' => 'required'
    	]);
    	$data = request(['title', 'content']);
    	$data['user_id'] = \Auth::id();
    	Article::create($data);
    	return redirect('/');
    }

    public function detail(Article $article)
    {
        $comments = $article->comments()->paginate();
        return view('article.detail', compact('article', 'comments'));
    }

    public function edit(Article $article)
    {
        $this->authorize('update', $article);

        return view('article.edit', compact('article'));
    }

    public function update(Article $article)
    {
        $this->authorize('update', $article);

        $this->validate(request(),[
            'title' => 'required|max:100',
            'content' => 'required'
        ]);
        $article->title = request('title');
        $article->content = request('content');
        $article->save();
        return redirect("/article/$article->id");
    }

    public function delete(Article $article)
    {
        $this->authorize('delete', $article);

        $article->delete();
        
        return redirect("/");
    }

    public function comment(Article $article)
    {
        $this->validate(request(), [
            'content' => 'required'
        ]);
        $data['content'] = request('content');
        $data['article_id'] = $article->id;
        $data['user_id'] = \Auth::id();
        Comment::create($data);
        return back();
    }

    public function zan(Article $article)
    {
        $data = [
            'article_id' => $article->id,
            'user_id'    => \Auth::id()
        ];
        \App\Zan::firstOrCreate($data);
        return back();
    }

    public function unzan(Article $article)
    {
        $article->zan(\Auth::id())->delete();
        return back();
    }

    public function time(Article $article)
    {
        $year  = request('year');
        $month = request('month');
        $date = $year . '-' . $month;
        $firstday = date('Y-m-01', strtotime($date));
        $lastday = date('Y-m-d', strtotime("$firstday +1 month -1 day"));
        $articles = $article->whereBetween('created_at', [$firstday, $lastday])->orderBy('created_at', 'desc')->paginate(5);
        return view('index.index', compact('articles'));
    }
}
