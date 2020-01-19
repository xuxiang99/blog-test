@extends('layouts.base')

@section('main')

<div class="col-sm-8">
    <blockquote>
        <p><img src="/images/user.jpeg" alt="" class="img-rounded" style="border-radius:500px; height: 40px">{{ $user->name }}</p>
        <footer>关注：{{ $user->stars_count }}｜粉丝：{{ $user->fans_count }}｜文章：{{ $user->articles_count }}</footer>

        @include('layouts.star', ['target_user' => $user])
    </blockquote>
</div>
<div class="col-sm-8 blog-main">
    <div class="nav-tabs-custom">
        <ul class="nav nav-tabs">
            <li class="active"><a href="#tab_1" data-toggle="tab" aria-expanded="true">文章</a></li>
            <li class=""><a href="#tab_2" data-toggle="tab" aria-expanded="false">关注</a></li>
            <li class=""><a href="#tab_3" data-toggle="tab" aria-expanded="false">粉丝</a></li>
        </ul>
        <div class="tab-content">
            
            <div class="tab-pane active" id="tab_1">
            @if (count($articles) != 0)
                @foreach ($articles as $article)
                    <div class="blog-post" style="margin-top: 30px">
                        <p><a href="/user/{{ $article->user->id }}">{{ $article->user->name }}</a> {{ \Carbon\Carbon::parse($article->created_at)->diffForHumans() }}</p>
                        <p><a href="/article/{{ $article->id }}">{{ $article->title }}</a></p>
                        <p>{!! $article->content !!}</p>
                    </div>
                @endforeach
            @endif
            </div>
             
            <div class="tab-pane" id="tab_2">
            @if (count($susers) != 0)
                @foreach ($susers as $suser)
                    <div class="blog-post" style="margin-top: 30px">
                        <p class=""><a href="{{ $suser->id }}">{{ $suser->name }}</a></p>
                        <p class="">关注：{{ $suser->stars_count }} | 粉丝：{{ $suser->fans_count }}｜ 文章：{{ $suser->articles_count }}</p>
                        @include('layouts.star', ['target_user' => $suser])
                    </div>
                @endforeach
            @endif
            </div> 
            
            
            <div class="tab-pane" id="tab_3">
            @if (count($fusers) != 0)
                @foreach ($fusers as $fuser)
                <div class="blog-post" style="margin-top: 30px">
                    <p class=""><a href="{{ $fuser->id }}">{{ $fuser->name }}</a></p>
                    <p class="">关注：{{ $fuser->stars_count }} | 粉丝：{{ $fuser->fans_count }}｜ 文章：{{ $fuser->articles_count }}</p>
                     @include('layouts.star', ['target_user' => $fuser])
                </div>
                @endforeach
            @endif
            </div>        
        </div>
        
    </div>
</div>

@endsection()
