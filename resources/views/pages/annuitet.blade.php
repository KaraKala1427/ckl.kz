@extends('layouts.general')

@section('content')
            @include('mini_parts.callback')
{{--            <section class="hero" style="background-image: url({{ asset('images/a.jpg')}}); position: relative;">--}}
            <section class="hero" style="background-image: url({{ asset('images/anuit.jpg')}}); position: relative;">
                <div class="hero__content">
                    <h1 class="hero__title"></h1>
                    <div class="hero__maintext hero__maintext--bigger">
                        <p></p>
                    </div>
                    <div class="hero__helptext">
                        <p></p>
                    </div>

                    <div class="carousel__tabs" style="bottom: 0px; position: absolute;">
                        <nav class="nav nav--tabs nav--hero nav--carousel" id="hidemenu">
                            <ul class="nav__list product_list" data-tabs="">
                                <li><a href="{{ route('product')}}" data-link="hcp_page"
                                       class="link nav__item nav__item--tab ">{{ __('navbar.mf15')}}</a></li>
                                <li><a href="{{ route('annuitet') }}" data-link="ann_page"
                                       class="link nav__item nav__item--tab active">{{ __('navbar.mf16')}}</a></li>
                                <li><a href="{{ route('live') }}" data-link="live_page"
                                       class="link nav__item nav__item--tab live">{{ __('navbar.mf17')}}</a></li>
                                <li><a href="{{ route('retirementinsurance') }}" data-link="live_page"
                                       class="link nav__item nav__item--tab">{{ __('navbar.mf18')}}</a></li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </section>
            <br>

            <div class="about_news">


                <div class="article-page__intro">

                @foreach($articles as $article)

                    <!-- .promo__period -->
                        <h2 class="article__title">{{ $article->{'name_'.App::getLocale()} }}</h2>
                </div>
                <!-- Картинка если имеется -->


                <div class="level_news">
                    <article class="left_news_block">
                        @if($article->{'img_ru'} == '')
                            {{null}}
                        @else
                            <figure class="card__image">
                                <img src="{{  $article->{'img_ru'} }}" alt="">
                            </figure>
                    @endif


                    <!-- Текстовое составляющие блока -->

                        <section class="article__text">
                            <div>
                                <p> {!! $article->{'tex_'.App::getLocale()} !!}</p>
                            </div>
                        </section>

                        <!-- Текстовое составляющие блока конец-->


                    </article>


                </div>

                <!-- the end page_grind-->
            </div>
            <br>
            @endforeach
            <div id="ann_page" class="blocker">

                <section class="faq">
                    <h2 class="faq__title">{{ __('navbar.faq')}}</h2>
                    <div class="faq__list grid">
                        @foreach($questions as $question)
                            <div class="faq__item"><h4 class="faq__question">{{ $question->{'name_'.App::getLocale()} }}</h4>
                                <div class="faq__answer">{!! $question->{'tex_'.App::getLocale()} !!}
                                </div>
                            </div>
                        @endforeach
                    </div>
                </section>
            </div>
            @include('mini_parts.callback_mail', ['frompage' => 'Аннуитетное страхование https://ckl.kz/annuitet'])
        <!-- end container -->
    </main>
    <!-- end main -->

@endsection
