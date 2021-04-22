@extends('layouts.general')

@section('content')

    <div class="about_news">


        <div class="article-page__intro">
            <div class="article-page__period">{{ $article->pubdat }}</div>
            <!-- .promo__period -->
            <h2 class="article__title">
                @if($article->{'name_'.App::getLocale()} =='')
                    {{ $article->name_ru }}
                @else
                     {{ $article->{'name_'.App::getLocale()} }}
                @endif
            </h2>
        </div>
        <!-- Картинка если имеется -->


        <div class="level_news">
            <article class="left_news_block">

                @if($article->img_ru !='')
                    <figure class="card__image">
                        <img src="{{ $article->img_ru }}" alt="упс картинка пропал НАчальника" >
                    </figure>
                @else
                    {{ null }}
                @endif
                <!-- Текстовое составляющие блока -->

                <section class="article__text">
                    <b>{{$article->{'head_'.App::getLocale()} }}</b>
                    <div>
                        @if($article->{'tex_'.App::getLocale()} !='')
                            {!! $article->{'tex_'.App::getLocale()} !!}
                        @else
                            {!! $article->tex_ru !!}
                        @endif
                    </div>
                </section>

                <!-- Текстовое составляющие блока конец-->

                <div class="mobile_other_news">
                    <h3 class="aside__title">{{__('sm')}}</h3>

                    <!-- .card card--promo -->
                    @foreach($other_articles as $other_article)
                    <div class=" blockblock card--border">

                        <div class="card__body">
                            <div class="card__period"><span class="period">{{$other_article->pubdat}}</span></div>
                            <h4 class="card__title">
                                <a href="{{ $other_article->route() }}" class="link" style="font-size: 27px;">
                                    @if($other_article->{'name_'.App::getLocale()} !='')
                                        {{ $other_article->{'name_'.App::getLocale()} }}
                                    @else
                                        {{ $other_article->name_ru }}
                                    @endif
                                </a>
                            </h4>
                            <div class="card__desc destroy_text">
                                @if($other_article->{'tex_'.App::getLocale()} !='')
                                    {!! $other_article->{'tex_'.App::getLocale()} !!}
                                @else
                                    {!! $other_article->tex_ru !!}
                                @endif
                            </div>
                        </div>
                    </div>
                    @endforeach
                    <br>
                </div>
            </article>

            <div class="other_news">

                <h3 class="aside__title">{{ __('sm') }}</h3>

                <!-- .card card--promo -->
                @foreach($other_articles as $other_article)
                <div class=" blockblock card--border">

                    <div class="card__body">
                        <div class="card__period"><span class="period">{{$other_article->pubdat}}</span></div>
                        <h4 class="card__title">
                            <a href="{{ $other_article->route() }}" class="link" style="font-size: 27px;">
                                @if($other_article->{'name_'.App::getLocale()} !='')
                                    {{ $other_article->{'name_'.App::getLocale()} }}
                                @else
                                    {{ $other_article->name_ru }}
                                @endif
                            </a>
                        </h4>
                        <div class="card__desc destroy_text">
                            @if($other_article->{'tex_'.App::getLocale()} !='')
                                {!! $other_article->{'tex_'.App::getLocale()} !!}
                            @else
                                {!! $other_article->tex_ru !!}
                            @endif
                        </div>
                    </div>
                </div>
                @endforeach

            </div>

        </div>

        <style>
            .removejust {
                display: none;
            }
            .article-page__intro {
                margin-left: 20px;
            }
            @media (max-width: 991px) {
                main {
                    padding: 0 0;

                }
            }
            .level_news {
                display: flex;
                flex-direction: row;
                flex-wrap: wrap;
                width: 100%;
                padding: 20px;
                justify-content: space-between;
            }
            .left_news_block  {
                width: 70%;
            }
            .mobile_other_news {
                display: none;
            }

            .destroy_text {
                height: 95px;
                overflow: hidden;
                text-overflow: ellipsis;
            }

            .other_news {
                display: flex;
                flex-direction: column;
                width: 24%;
            }

            .blockblock {
                margin: 10px;
                width: 100%;
            }
            @media (max-width: 767px) {
                .other_news {
                    display: none;
                }
                .left_news_block {
                    width: 100%;
                }
                .mobile_other_news {
                    margin: 40px 0 0 0;
                    display: block;
                }
                .blockblock {
                    margin: 40px 0;
                }
                .article-page__period {
                    font-size: 14px;
                }
                h2 {
                    font-size: 22px;
                }
            }



        </style>
        <!-- the end page_grind-->
    </div>
    <!-- the end Tiles-->
    </div>
    </main>
@endsection
