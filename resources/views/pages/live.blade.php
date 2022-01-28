@extends('layouts.general')

@section('content')
        @include('mini_parts.callback')
{{--        <section class="hero" style="background-image: url({{ asset('images/l.jpg')}}); position: relative;">--}}
        <section class="hero" style="background-image: url({{ asset('images/strlife.jpg')}}); position: relative;">
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
                                   class="link nav__item nav__item--tab">{{ __('navbar.mf16')}}</a></li>
                            <li><a href="{{ route('live') }}" data-link="live_page"
                                   class="link nav__item nav__item--tab live active">{{ __('navbar.mf17')}}</a></li>
                            <li><a href="{{ route('retirementinsurance') }}" data-link="live_page"
                                   class="link nav__item nav__item--tab">{{ __('navbar.mf18')}}</a></li>
                            <li><a href="{{ route('covid') }}" data-link="live_page"
                                   class="link nav__item nav__item--tab">{{ __('navbar.mf26')}}</a></li>
                        </ul>
                    </nav>
                </div>
            </div>
        </section>
        <br>


        <div class="tiles tiles--business">
            <div class="tiles__item">
                <img src="{{asset('images/cards/gruppovoe.jpg')}}" alt="групповое" class="tiles__image" />
                <a href="{{route('live_gccj')}}" class="overlay" title="Групповое срочное страхование жизни"></a>
                <h3 class="tiles__title">Групповое срочное страхование жизни</h3>
            </div>
            <div class="tiles__item">
                <img src="{{asset('images/cards/zaemwik.jpg')}}" alt="заемщик" class="tiles__image" />
                <a href="{{route('live_zaemwik')}}" class="overlay" title="Страхование жизни заемщика"></a>
                <h3 class="tiles__title">Страхование жизни заемщика</h3>
            </div>
            <div class="tiles__item">
                <img src="{{asset('images/cards/nsjupp.jpg')}}" alt="нсжуп" class="tiles__image " />
                <a href="{{route('live_nsj')}}" class="overlay" title="Накопительное страхование жизни с участием в прибыли"></a>
                <h3 class="tiles__title img_text_bottom">Накопительное страхование жизни с участием в прибыли</h3>
            </div>
            <div class="tiles__item">
                <img src="{{asset('images/cards/nsj_rebenka.jpg')}}" alt="нсжуп ребенок" class="tiles__image " />
                <a href="{{route('live_nsj_rebenka')}}" class="overlay" title="Накопительное страхование жизни в пользу ребенка"></a>
                <h3 class="tiles__title img_text_bottom">Накопительное страхование жизни в пользу ребенка</h3>
            </div>
            <div class="tiles__item">
                <img src="{{asset('images/cards/valutnyi.jpg')}}" alt="валютное" class="tiles__image" />
                <a href="{{route('live_nsj_valutnyi')}}" class="overlay" title="Накопительное страхование жизни - Валютный"></a>
                <h3 class="tiles__title">Накопительное страхование жизни - Валютный</h3>
            </div>
        </div>
        <style>
            .localgrid {
                width: 100%;
                display: flex;
                justify-content: center;
                align-items:center;
            }
            .localgrid section {
                width: 77%;
                margin: 10px auto;
            }
            .removejust {
                display: none;
            }

            .card__image {
                width: 80%;
                height: 400px;
            }
            .card__image img{
                width: 100%;
            }
            @media (max-width: 991px) {
                .card__image {
                    width: 80%;
                    height: 150px;
                }

            }
        </style>

    <!-- end container -->
</main>
<!-- end main -->
@endsection
