@extends('layout.main')
@section("css")
    <link rel="stylesheet" href="{{ mix('/css/index.css') }}">
@endsection
@section("content")
    <div class="container_wrap main">
        @include('layout.alert')
        <ul class="left_menu l">
            <li @if($category->exists) class="m_item" @else class="m_item active" @endif>
                <a href="/">最新</a>
            </li>
            @foreach($categorys as $item)
                <li @if($category->exists && $item->id == $category->id) class="m_item active" @else class="m_item" @endif>
                    <a href="/category/{{ $item->id }}">{{ $item->name }}</a>
                </li>
            @endforeach
        </ul>
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
            <div class="user-wrap">
                <div class="clearfix">
                    <h3 class="title">最新评论</h3>
                </div>
                <ul class="user-list clearfix">
                    @foreach($comments as $comment)
                        <li class="user">
                            <div class="info">
                                <div class="avatar">
                                    <img src="{{ $comment->owner->avatar }}">
                                </div>
                                <span class="nickname">{{ $comment->owner->name }}</span>
                                <span>评论了</span>
                                <span class="title">{{ $comment->post->title }}</span>
                            </div>
                            <div class="content">
                                {{ $comment->body }}
                            </div>
                            <div class="time">
                                {{ $comment->created_at->diffForHumans() }}
                            </div>
                        </li>
                    @endforeach

                </ul>
            </div>
        </div>
    </div>
@endsection