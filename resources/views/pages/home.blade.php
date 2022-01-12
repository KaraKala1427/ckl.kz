@extends('layouts.general')

@section('content')

            <div class="container s">
                <section class="hero" style="background-image: url({{ URL::to('/') }}/images/strlife.jpg);">
                    <div class="hero__content">
                        <h1 class="hero__title"></h1>
                        <div class="hero__maintext hero__maintext--bigger">
                            <p></p>
                        </div>
                        <div class="hero__helptext">
                            <p></p>
                        </div>
                    </div>

                </section>
                <div class="carousel__tabs carousel__tabsmain" style="bottom: 90px;">
                    <nav class="nav nav--tabs nav--hero nav--carousel" id="hidemenu">
                        <ul class="nav__list product_list" data-tabs="">
                            <li><a href="{{ route('product')}}" data-link="hcp_page"
                                   class="link nav__item nav__item--tab">{{ __('navbar.mf15')}}</a></li>
                            <li><a href="{{ route('annuitet') }}" data-link="ann_page"
                                   class="link nav__item nav__item--tab">{{ __('navbar.mf16')}}</a></li>
                            <li><a href="{{ route('live') }}" data-link="live_page"
                                   class="link nav__item nav__item--tab live">{{ __('navbar.mf17')}}</a></li>
                            <li><a href="{{ route('retirementinsurance') }}" data-link="live_page"
                                   class="link nav__item nav__item--tab">{{ __('navbar.mf18')}}</a></li>
                        </ul>
                    </nav>
                </div>

                <div class="for_block">
                    <div class="block_main">
                        <div class="under_block1"><a href='{{ route('product') }}'> {{ __('navbar.osns_tit')}} </a></div>
                        <div class="under_block"><img src="{{ asset('images/main/1.jpg')}}"></div>
                    </div>
                    <div class="block_main">
                        <div class="under_block1"><a href='{{ route('annuitet') }}'> {{ __('navbar.mf16')}} </a></div>
                        <div class="under_block"><img src="{{ asset('images/main/2.jpg')}}"></div>
                    </div>
                    <div class="block_main">
                        <div class="under_block1"><a href='{{ route('retirementinsurance') }}'>{{ __('navbar.mf18')}}</a></div>
                        <div class="under_block"><img src="{{ asset('images/main/3.jpg')}}"></div>
                    </div>
                    <div class="block_main">
                        <div class="under_block1"><a href='{{ route('live') }}'>{{ __('navbar.mf17')}}</a></div>
                        <div class="under_block"><img src="{{ asset('images/main/4.jpg')}}"></div>
                    </div>
                </div>
                <!-- end tiles -->
                <section class="news">
                    <h2 class="news__title">{{ __('navbar.newsd') }}</h2>
                    <div class="grid news__list">

                        @foreach($articles as $article)
                        <div class="col col--3-12">
                            <div class="news__item">
                                <div class=" blockblock @if($article->show_thumb == '2') card--image @else card--border @endif">
                                    @if($article->show_thumb == '1' || $article->show_thumb == '2')
                                        <figure class="card__image">
                                            <a href="{{ $article->route() }}"
                                               class="overlay">
                                            </a>
                                            <img src="{{ asset("storage/".$article->{'img_'.App::getLocale()})}}"
                                                 alt="">
                                        </figure>
                                    @endif

                                    <div class="card__body">
                                        <div class="card__period"><span class="period">{{ (new \Illuminate\Support\Carbon($article->pubdat))->format('Y-m-d') }}</span></div>
                                        <h4 class="card__title">
                                            <a href="{{ $article->route() }}" class="link" style="font-size: 27px;">
                                                @if($article-> {'name_'.App::getLocale() } != '')
                                                    {{$article-> {'name_'.App::getLocale() } }}
                                                @else
                                                    {{$article-> {'name_ru' } }}
                                                @endif
                                            </a>
                                        </h4>
                                        @if($article-> {'head_'.App::getLocale() } != '')
                                            {{$article-> {'head_'.App::getLocale() } }}
                                        @elseif($article-> {'head_ru' } != '')
                                            {{ $article-> {'head_ru' }  }}
                                        @else
                                            {{ null }}
                                        @endif
                                        <div class="card__desc destroy_text">
                                            @if($article-> {'tex_'.App::getLocale() } != '')
                                                {!! $article-> {'tex_'.App::getLocale() }  !!}
                                            @else
                                                {!!$article-> {'tex_ru' } !!}
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- end news__item -->
                        </div>
                        @endforeach
                    </div>
                </section>
            </div>

            <style>
                .removejust{
                    display: none;
                }
                section.nav-section{
                    display: none;
                }
                .card-body{
                    display: none;
                }
            </style>
    </main>



@endsection
