@foreach ($articles as $article)
<div class="article-box">
    {{-- <div class="article-box-left"></div> --}}
    <div class="article-box-left">
        @if (empty(Auth::user()->avatar))
        <img src="/img/avatar/user.svg" alt="avatar" style="width:40px; height:40px; border-radius:50%?vertical-align: middle;">
        @else
        <img src="{{ asset('/img/avatar/'.Auth::user()->avatar) }}" alt="avatar" style="width:40px; height:40px; border-radius:50%" border-radius="50%">
        @endif
    </div>
    <div class="article-box-right">
        <a class="article-title" href="/post/{{$article->id}}">{{ $article->title }}</a>
        <div class="article-details">
            <div class="article-date">{{ $article->created_at }}</div>
        </div>
        <like
        :post-id="{{ json_encode($article['id']) }}"
        :user-id="{{ json_encode($userAuth->id) }}"
        :default-Liked="{{ json_encode(\App\Post::defaultLiked($article, $userAuth->id)) }}"
        :default-Count="{{ json_encode(count($article['likes'])) }}"
        ></like>
    </div>
</div>
@endforeach
<example-component></example-component>

{{-- {!! $articles->render() !!}
// ページャー --}}
