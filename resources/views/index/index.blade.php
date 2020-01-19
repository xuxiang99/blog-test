@extends('layouts.base')

@section('main')
<div class="mainbar">

  @foreach ($articles as $article)
    <div class="article">
      <a style="font-weight:bold;font-size:16px;color:black;cursor:pointer" href="/article/{{ $article->id }}">
        {{ $article->title }}
      </a>
      <div class="clr"></div>
      <p><span style="color:green">{{ \Carbon\Carbon::parse($article->created_at)->diffForHumans() }}</span> <span style="color:orange">by</span> <a href="/user/{{ $article->user->id }}">{{ $article->user->name }}</a></p>
      <div class="clr"></div>
      <p>{!! $article->content !!}</p>
      <div>赞 {{ $article->zans_count }} | 评论 {{ $article->comments_count }}</div>
    </div>
  @endforeach
  
  {{ $articles->links() }}

</div>

@endsection