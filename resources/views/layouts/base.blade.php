<!DOCTYPE html>
<html lang="zh-CN">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="csrf-token" content="{{ csrf_token() }}">
<title>blog</title>
<link rel="stylesheet" href="https://cdn.bootcss.com/bootstrap/3.3.7/css/bootstrap.min.css">
<link rel="stylesheet" href="/css/style.css"/>
<link rel="stylesheet" href="/css/blog.css">
<link rel="stylesheet" href="/css/wangEditor.min.css">
<script type="text/javascript" src="/js/cufon-yui.js"></script>
<script type="text/javascript" src="/js/arial.js"></script>
<script type="text/javascript" src="/js/cuf_run.js"></script>
</head>
<body>
<div class="main">

  @include('layouts.header')

  <div class="content">
    <div class="content_resize">

      @yield('main')

      @include('layouts.sidebar')

    </div>
  </div>

  @include('layouts.footer')
  
</div>

<script src="https://cdn.bootcss.com/jquery/1.12.4/jquery.min.js"></script>
<script src="https://cdn.bootcss.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script type="text/javascript" src="/js/wangEditor.min.js"></script>
<script type="text/javascript" src="/js/blog.js"></script>

</body>
</html>
