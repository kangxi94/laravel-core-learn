@extends('layout.main')
@section('css')
    <link rel="stylesheet" href="{{ mix('/css/search.css') }}">
@endsection
@section('content')
    <div class="container_wrap main">
        @include('layout.alert')
        <div class="centerlist l">
            <div class="article-wrapper clearfix">
                <div class="article-list">
                    @foreach($posts as $post)
                        <div class="article">
                            <div class="imgCon l">
                                <img src="{{$post->user->avatar}}">
                            </div>
                            <div class="list-content l">
                                <a href="/post/{{$post->id}}" target="_blank" class="title"><p>{{ $post->title  }}</p></a>
                                <div class="list-bottom">
                                    <div class="labels-area l">
                                        <a href="/u/3612519" class="nickName l" target="_blank">
                                            {{$post->user->name}}
                                        </a>
                                        <span class="skill l">
                                            @foreach($post->topics as $topic )
                                                <span class="style{{ $topic->id%30 }}">{{ $topic->name }}</span>
                                            @endforeach()
                                        </span>
                                        <div class="browseNum l">
                                            <div class="item">
                                                <span class="iconfont icon-guankan"></span>
                                                <span>{{ $post->watch_count  }}</span>
                                            </div>
                                            <div class="item">
                                                <span class="iconfont icon-liuyan"></span>
                                                <span>{{ $post->comment_count  }}</span>
                                            </div>
                                            <div class="item">
                                                <span class="iconfont icon-dianzan1"></span>
                                                <span>{{ $post->fav_count  }}</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="createTime r">
                                        {{ $post->created_at->diffForHumans()  }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="navigation">
                    {{ $posts->links() }}
                </div>
            </div>
        </div>
        <div class="right_personalization r">
            <div class="rank-wrap">
                <div class="clearfix">
                    <h3 class="title">搜索排行榜</h3>
                </div>
                <ul class="rank-list">
                    @foreach($rank_list as $name => $count)
                        <li class="rank clearfix">
                            @if($loop->index < 3) <i class="prev">1</i> @else <i>1</i> @endif<span>{{ $name }}</span><em>{{ $count }}</em></li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
@endsection
@section('js')

@endsection
