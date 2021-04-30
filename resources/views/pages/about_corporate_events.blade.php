@extends('layouts.general')

@section('content')


            <div class="article-wrapper">
                <article class="article">
                    <h1>{{ __('navbar.corporate') }}</h1>
                    <dl>
                        <ul class="accordion collapse__content">
                            @foreach($articles as $article)


                                <li>
                                    <h3 class="accordion__toggle accordion__toggle--plus">{{ $article->{'name_'.App::getLocale()} }}</h3>
                                    <div class="accordion__inner">
                                        @if($article->{'tex_'.App::getLocale()} == '')
                                        {!! $article->{'tex_ru'} !!}
                                        @else
                                            {!! $article->{'tex_'.App::getLocale()} !!}
                                        @endif


                                    </div>
                                </li>

                            @endforeach
                        </ul>
                    </dl>
                </article>
            </div>
        </div>
    </main>
@endsection
