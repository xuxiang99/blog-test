<div id="app">
    <nav class="navbar navbar-default navbar-static-top">
        <div class="container">
            <div class="navbar-header">

                <!-- Collapsed Hamburger -->
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse" aria-expanded="false">
                    <span class="sr-only">Toggle Navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

                <!-- Branding Image -->
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
            </div>

            <div class="collapse navbar-collapse" id="app-navbar-collapse">
                <!-- Left Side Of Navbar -->
                <ul class="nav navbar-nav">
                    &nbsp;
                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="nav navbar-nav navbar-right">
                    <!-- Authentication Links -->
                    @guest
                        <li><a href="{{ route('login') }}">Login</a></li>
                        <li><a href="{{ route('register') }}">Register</a></li>
                    @else
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true" v-pre>
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>

                            <ul class="dropdown-menu">
                                <li>
                                    <a href="/user/{{ \Auth::id() }}">My Home</a>
                                </li>
                                <li>
                                    <a href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();">
                                        Logout
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        {{ csrf_field() }}
                                    </form>
                                </li>
                            </ul>
                        </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>
</div>

<div class="header">
  <div class="header_resize">
    <div class="logo">
      <h1><a href="/">Link<span> Interface</span></a><small>Simple web template</small></h1>
    </div>
    <div class="clr"></div>
    <div class="menu_nav">
      <ul>
        <li @if (Request::path() == '/') class="active" @endif><a href="/">首页</a></li>
        <li @if (Request::path() == 'article/create') class="active" @endif><a href="/article/create">写博客</a></li>
        <li @if (Request::path() == 'contact') class="active" @endif><a href="/contact">联系我们</a></li>
      </ul>
     <div class="search">
      <form action="/search" method="post">
        {{ csrf_field() }}
        <span>
        <input name="text" type="text" class="keywords" id="textfield" maxlength="50" value="{{ Session::get('search') }}" />
         </span>
        <input name="search" type="image" src="/images/search.gif" class="button" />
      </form>
    </div>
    <!--/search -->
    </div>
    <div class="clr"></div>
  </div>
</div>
<div class="clr"></div>