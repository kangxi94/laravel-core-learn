<div class="header">
    <div class="container_wrap">
        <a class="logo" href="/">
            <img src="http://www.imooc.com/static/img/article/article-logo.png" />
        </a>
        <div class="search-warp">
            <form action="/post/search" method="get">
                <input type="hidden" value="{{ csrf_token() }}">
                <div class="search-area">
                    <input class="search-input" @if(isset($query)) value="{{ $query }}" @endif name="query" placeholder="搜索感兴趣的知识和文章" autocomplete="off" />
                </div>
                <div class="showhide-search">
                    <button type="submit" class="submit">
                        <span class="iconfont icon-sousuo"></span>
                    </button>
                </div>
            </form>
        </div>
    </div>
    <div class="operate-area">
        <span class="article">
            <a href="/post/create" class="btn btn-blue">写文章</a>
        </span>
        <div class="user">
            @guest
                <a href="{{ route('login') }}" class="menu">登录</a>
                <a href="{{ route('register') }}" class="menu">注册</a>
            @else
            <div class="dropdown">
                <div type="button" id="dropdownMenu1" data-toggle="dropdown">
                    <a class="avatar">
                        <img src="{{ Auth::user()->avatar }}">
                    </a>
                    <span class="nickname">{{ Auth::user()->name }} </span>
                    <span class="caret"></span>
                </div>
                <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1">
                    <li role="presentation">
                        <a role="menuitem" tabindex="-1"  href="{{ route('logout') }}"
                           onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">退出</a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            {{ csrf_field() }}
                        </form>
                    </li>
                </ul>
            </div>
            @endguest

        </div>
    </div>


</div>