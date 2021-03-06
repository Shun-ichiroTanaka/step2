@extends('layouts.app')
@section('content')
<div id="app">
@yield('addtionalMeta')

    <div class="c-post__show">
        {{-- <div id="demo"> --}}
            <div class="c-step">
                <div class="c-post__show-left">
                    <div class="c-button__show-social">
                        @if (Auth::check())
                        <like
                            :post-id="{{ json_encode($post->id) }}"
                            :user-id="{{ json_encode($userAuth->id) }}"
                            :default-Liked="{{ json_encode($defaultLiked) }}"
                            :defaultlike-Count="{{ json_encode($defaultlikeCount) }}"
                        ></like>
                        <stock
                            :post-id="{{ json_encode($post->id) }}"
                            :user-id="{{ json_encode($userAuth->id) }}"
                            :default-Stocked="{{ json_encode($defaultStocked) }}"
                            :defaultstock-Count="{{ json_encode($defaultstockCount) }}"
                        ></stock>
                        <div class="c-button__show-social__twitter">
                            <a href="javascript:window.open('http://twitter.com/share?text='+encodeURIComponent(document.title)+'&url='+encodeURIComponent(location.href),'sharewindow','width=550, height=450, personalbar=0, toolbar=0, scrollbars=1, resizable=!');"><img src="/img/social/twitter.svg" alt="Twitterでシェアをする"></a>
                        </div>
                        @else
                        <a href="/login">
                            <like :defaultlike-Count="{{ json_encode($defaultlikeCount) }}"></like>
                            <stock :defaultstock-Count="{{ json_encode($defaultstockCount) }}"></stock>
                        </a>
                        <div class="c-button__show-social__twitter">
                           <a href="javascript:window.open('http://twitter.com/share?text='+encodeURIComponent(document.title)+'&url='+encodeURIComponent(location.href),'sharewindow','width=550, height=450, personalbar=0, toolbar=0, scrollbars=1, resizable=!');"><img src="/img/social/twitter.svg" alt="Twitterでシェアをする"></a>
                        </div>
                        @endif
                        {{-- <a href="#" class="c-button__show-social__twitter"><img src="{{ asset('/img/social/twitter.svg') }}" alt="twitter"></a> --}}
                    </div>
                </div>

                <div class="c-post__show-main">
                    <div class="c-post__show-main__header">
                        <div class="c-post__show-main__header-list">
                            <div>
                                <a href="/user/{{$post->user_id}}">
                                    @if (empty($post->user->avatar))
                                        <img src="/img/avatar/user.svg" alt="avatar">
                                    @else
                                        <img src="{{ asset('/img/avatar/'.$post->user->avatar) }}" alt="avatar">
                                    @endif
                                </a>
                            </div>
                            <div class="c-post__show-main__header-list__name"> <a href="/user/{{$post->user_id}}">{{ $post->user->name }}</a></div>
                            <div class="c-post__show-main__header-list__date">{{ $post->created_at }}に投稿</div>
                            @if ($post->clearTime)
                                <div class="c-post__show-main__header-list__time">目標時間 : {{ $post->clearTime }}</div>
                            @endif
                        </div>
                    </div>
                    {{-- タイトル --}}
                    <div class="c-post__show-title">{{$post->title}}</div>
                    {{-- タグ --}}
                    <div class="c-post__show-tags">
                        <div class="c-post__show-tags__item">{{$post->tag1}}</div>
                        @if ($post->tag2)
                        <div class="c-post__show-tags__item">{{$post->tag2}}</div>
                        @endif
                        @if ($post->tag3)
                        <div class="c-post__show-tags__item">{{$post->tag3}}</div>
                        @endif
                        @if ($post->tag4)
                        <div class="c-post__show-tags__item">{{$post->tag4}}</div>
                        @endif
                        @if ($post->tag5)
                        <div class="c-post__show-tags__item">{{$post->tag5}}</div>
                        @endif
                    </div>
                    {{-- Vue-Editor プラグイン --}}


                    <div class="c-post__show-markdown">   
                        @foreach ($steps as $step)
                            <h2 class="">{{$step->name}}</h2>
                            <div class="">{{$step->body}}</div>
                        @endforeach
                    </div>
                </div>

                <div class="c-post__show-right">
                    @if (Auth::check())
                        <challenge
                            :post-id="{{ json_encode($post->id) }}"
                            :user-id="{{ json_encode($userAuth->id) }}"
                            :default-Challenged="{{ json_encode($defaultStocked) }}"
                            :defaultchallenge-Count="{{ json_encode($defaultstockCount) }}"
                        ></challenge>                       
                    @else
                        <a href="/login">
                            <challenge :defaultchallenge-Count="{{ json_encode($defaultlikeCount) }}"></challenge>
                        </a>
                    @endif
                    <div class="step-app-side c-step__side">
                        {{-- 目次 --}}
                        <p>STEP一覧</p>
                        <div class="toc" data-toc="h2"></div>
                    </div>
                </div>
            </div>
        </div>
    {{-- </div> --}}
</div>
@endsection
<script type="text/javascript">
    document.title = `{{ $post['title'] }}`
</script>