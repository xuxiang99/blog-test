@extends('layouts.base')

@section('main')
	<div class="col-sm-8">
        <blockquote>
            <p style="font-size:16px;color:black">{{ $tag->name }}</p>
            <footer>文章：{{ $tag->articles_count }}</footer>
            <button class="btn btn-default topic-submit"  data-toggle="modal" data-target="#topic_submit_modal" topic-id="{{ $tag->id }}" _token="MESUY3topeHgvFqsy9EcM916UWQq6khiGHM91wHy" type="button">投稿</button>
        </blockquote>
    </div>
    <div class="modal fade" id="topic_submit_modal" tabindex="-1" role="dialog" >
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <div style="text-align:center" id="myModalLabel">我的文章</div>
                </div>
                <div class="modal-body">
                    <form action="/tag/{{ $tag->id }}/submit" method="post">
                        {{ csrf_field() }}
                        @foreach ($myArticles as $myArticle)
                        	<div class="checkbox">
	                            <label>
	                                <input type="checkbox" name="post_ids[]" value="{{ $myArticle->id }}">
	                                {{ $myArticle->title }}
	                            </label>
	                        </div>
                        @endforeach
                        
                        <button type="submit" class="btn btn-default">投稿</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-8 blog-main">
        <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
                <li class="active"><a href="#tab_1" data-toggle="tab" aria-expanded="true">文章</a></li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane active" id="tab_1">
                    @foreach ($articles as $article)
                    	<div class="blog-post" style="margin-top: 30px">
                            <p><a href="/user/{{ $article->user->id }}">{{ $article->user->name }}</a> {{ \Carbon\Carbon::parse($article->created_at)->diffForHumans() }}</p>
                            <p><a href="/article/{{ $article->id }}" >{{ $article->title }}</a></p>
                            <p>{!! $article->content !!}</p>
                        </div>
                    @endforeach
                </div>

            </div>
            <!-- /.tab-content -->
        </div>


    </div><!-- /.blog-main -->
@endsection