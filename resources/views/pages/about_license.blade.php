@extends('layouts.general')

@section('content')

    <div class="article-wrapper">
        <article class="article">
            @foreach($articles as $article)
                <h1 class="article__title">{{$article->{'name_'.App::getlocale()} }}</h1>
                <p>
                    {!! $article->{'tex_'.App::getlocale()} !!}
                </p>
                <div class="thumb__box">
                    <a href="{{$article->img_ru }}" class="js-lightbox-trigger overlay">
                    

                    </a>
                    <figure>
                        <img src="{{$article->img_ru }}" alt=""  title="" style="float:left;"><br>
                    </figure>
                </div>

            @endforeach

        </article>
    </div>
    </div>
    </main>
    <!-- end main -->
@endsection
