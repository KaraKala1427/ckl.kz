@extends('layouts.general')

@section('content')

      <div class="article-wrapper">
                <article class="article">
                    <h1 class="article__title">{{ __('navbar.finance') }}</h1>
                    <dl>
                        <ul class="accordion collapse__content">
                    @foreach($articles as $article)


                            <li>
                                <h3 class="accordion__toggle accordion__toggle--plus">{{ $article->{'name_ru'} }}</h3>
                                <div class="accordion__inner">
                                    {!! $article->{'tex_ru'} !!}
                                </div>
                            </li>


                    @endforeach
                        </ul>
                    </dl>
                </article>
            </div>
        </div>
    </main>
    <!-- end main -->
@endsection
