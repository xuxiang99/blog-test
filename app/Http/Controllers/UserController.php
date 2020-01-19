<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class UserController extends Controller
{
    public function index(User $user)
    {
    	// 用户中心
    	$user = User::withCount(['fans','stars','articles'])->find($user->id);
    	// 文章
    	$articles = $user->articles()->orderBy('created_at', 'desc')->take(10)->get();
    	// 关注的人
    	$stars = $user->stars();
    	$susers = User::whereIn('id', $stars->pluck('star_id'))->withCount('stars', 'fans', 'articles')->get();
    	// 粉丝
    	$fans = $user->fans();
    	$fusers = User::whereIn('id', $fans->pluck('fan_id'))->withCount('stars', 'fans', 'articles')->get();
    	return view('center.index', compact('user', 'articles', 'susers', 'fusers'));
    }

    public function fan(User $user)
    {
    	\Auth::user()->doFan($user->id);
    	return [
    		'error' => 0,
    		'msg'	=> '关注成功'
    	];
    }

    public function unFan(User $user)
    {
    	\Auth::user()->doUnFan($user->id);
    	return [
    		'error' => 0,
    		'msg'	=> '取关成功'
    	];
    }
}
