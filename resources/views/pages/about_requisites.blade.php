@extends('layouts.general')

@section('content')


            <div class="clr content__static"></div>
            <div class="article-wrapper">
                <article class="article">
                    @foreach($articles as $article)
                    <h1 class="article__title">{{ $article->{'name_'.App::getLocale()} }}</h1>
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
