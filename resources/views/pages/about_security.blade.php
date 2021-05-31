@extends('layouts.general')

@section('content')

    <div class="clr content__static"></div>
    <div class="article-wrapper">
        <article class="article">
            @foreach($articles as $article)
            <h1 class="article__title">{{ $article->{'name_'.App::getLocale()} }}</h1>
            <div><span style='font-weight:bold;'>{{ $article->{'head_'.App::getLocale()} }}</span></div>
            <div><span style="font-weight: 400; letter-spacing: 0px; word-spacing: 0.1em;">
                @if($article->{'tex_'.App::getLocale()} == '')
                    {!! $article->{'tex_ru'} !!}
                @else
                    {!! $article->{'tex_'.App::getLocale()} !!}
                @endif</div>
            @endforeach

        </article>
    </div>
    </div>
    </main>
    <!-- end main -->
@endsection
