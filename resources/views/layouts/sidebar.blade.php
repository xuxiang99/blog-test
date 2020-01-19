<div class="sidebar">
  <div class="gadget">
    <div style="font-size: 15px;text-align: center;">标签</div>
    <div class="clr"></div>
    <ul class="sb_menu">
      @foreach ($tags as $tag)
        <li><a href="/tag/{{ $tag->id }}">{{ $tag->name }}</a></li>
      @endforeach
    </ul>
  </div>
  <div class="gadget">
    <div style="font-size: 15px;text-align: center;">归档</div>
    <div class="clr"></div>
    <ul class="ex_menu">
      @foreach ($times as $time)
         <li><a href="/article/{{ $time }}" title="Website Templates">{{ $time }}</a></li>
      @endforeach
    </ul>
  </div>
</div>
<div class="clr"></div>