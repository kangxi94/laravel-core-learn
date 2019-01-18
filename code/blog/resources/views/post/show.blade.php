@extends('layout.main')
@section('css')
    <link rel="stylesheet" href="{{ mix('/css/post.css') }}">
@endsection
@section('content')
    <div class="main_con clearfix">
        <div class="active-box">
            <share></share>
        </div>
        <div class="left_essay l">
            <div class="part_essay">
                <div class="firstPublishImg">
                </div>
                <div class="detail-path">
                    <a href="/article/fe" target="_blank" class="js-column">{{ $post->category->name  }}</a>
                </div>
                <div class="detail-title-wrap">
                    <div class="detail-title">
                        <span class="d-t">{{ $post->title }}</span>
                    </div>
                    <div class="dc-profile clearfix">
                        <div class="l">
                            <span class="spacer">{{ $post->created_at }}</span>
                            <span class="spacer">{{ $post->watch_count }}浏览</span>
                        </div>
                        @can('update',$post)
                            <div class="r">
                                <a href="/post/{{$post->id}}/edit">
                                    <span class="glyphicon glyphicon-pencil"></span>
                                    编辑
                                </a>
                                <a href="javascript:;" onclick="deletePost({{$post->id}})">
                                    <span class="glyphicon glyphicon-remove"></span>
                                    删除
                                </a>
                            </div>
                        @endcan
                    </div>
                </div>
                <div class="detail-content-wrap">
                    <div class="detail-content">
                        {!! $post->body !!}
                    </div>
                    <div class="praise-box">
                        <zan :post_id="{{ $post->id }}"></zan>
                    </div>
                </div>
                <div class="comments">
                    <h4>评论列表:</h4>
                    @if($comments)
                        <comment-post :user_id="{{\Auth::id()}}" :comments="{{$comments}}" :post_id="{{$post->id}}" :collections="{{$comments['root']}}"></comment-post>
                    @endif
                </div>
            </div>
        </div>
        <div class="right_recommend r">
            <div class="author_info clearfix">
                <a href="/u/4951150/articles" class="l img_con" target="_blank">
                    <img src="{{ $post->user->avatar  }}">
                </a>
                <div class="text_con l">
                    <div class="name_con clearfix">
                        <p class="name l">
                            <a class="nick" href="/u/4951150/articles" title="CrazyCodeBoy" target="_blank">
                                {{ $post->user->name  }}
                            </a>
                        </p>
                        <p class="forward">
                        </p>
                    </div>
                    <div class="job">
					    <span class="job-icon"></span>
                    </div>
                    <div class="contribution clearfix">
                        <a href="/u/4951150/articles" target="_blank">
                            <span>{{ $post->user->post_count  }}</span> 篇手记
                        </a>
                    </div>
                </div>
            </div>
            <div class="other_article clearfix">
                <div class="title l">作者相关文章</div>
                <div class="more r">
                    <a href="/u/4951150/articles" target="_blank">更多><i class="imv2-arrow2_r"></i></a>
                </div>
                <ul class="l">
                    @foreach($other_posts as $other_post)
                        <li class="article-item clearfix">
                            <span class="iconfont icon-wenzhang"></span>
                            <a href="/post/{{ $other_post->id  }}" class="l" target="_blank">
                                <span>{{ $other_post->title  }}</span>
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script>
        function deletePost(post) {
            Swal(
                {
                    title: "确认删除?",
                    title : "确认删除?",
                    text : "确定要删除吗？",
                    type : "warning",
                    showCancelButton : true,
                    confirmButtonColor : '#DD6B55',
                    confirmButtonText : '确定',
                    cancelButtonText : "取消"
                }
            ).then( (res) => {
                if(res.value) {
                    window.location.href = '/post/'+post+'/delete';
                }
            });
        }
    </script>
@endsection
