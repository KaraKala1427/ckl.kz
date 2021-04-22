@extends('layouts.general')

@section('content')

            <div class="article-wrapper">

                <article class="article">
                    <h1 class="article__title">{{ $articles->{'name_'.App::getLocale()} }}</h1>
                    {!!  $articles->{'tex_'.App::getLocale()} !!}
                </article>
        </div>
        </div>
    </main>
    <!-- end main -->
@endsection
