@extends('layouts.base')

@section('main')

<div class="col-sm-8 blog-main" style="width:76%">
    <form action="/article/store" method="POST" enctype="multipart/form-data">
        {{ csrf_field() }}
        <div class="form-group">
            <label>标题</label>
            <input name="title" type="text" class="form-control" placeholder="这里是标题">
        </div>
        <div class="form-group">
            <label>内容</label>
            <textarea id="content" name="content" style="height:400px;max-height:500px;" class="form-control"></textarea>
        </div>

        <button type="submit" class="btn btn-default">提交</button>
    </form>
    <br>
</div>

@endsection