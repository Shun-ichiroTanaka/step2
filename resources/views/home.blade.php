{{--

＊トップページ

post-componentで投稿一覧を表示
左のサイドバーで検索機能・カテゴリー機能
右のサイドバーで人気ユーザーランキング表示

 --}}

@extends('layouts.app')

@section('content')
<div id="app">
    <div class="l-container">
        <div class="l-container__left">
            <h3>カテゴリーから探す</h3>
        </div>
        <div class="l-container__main">
              <posts></posts>

              {{-- @foreach ($posts as $post)
                <div class="">
                    <h3 class="">{{ $post->title }}</h3>
                    <a href="#" class="btn">{{ __('Go Practice')  }}</a>
                </div>
            @endforeach --}}
        </div>
        <div class="l-container__right">
            <div class="l-container__right-profile">
            </div>
        </div>
    </div>
</div>
@endsection
