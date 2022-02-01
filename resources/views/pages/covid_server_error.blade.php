@extends('layouts.general')

@section('content')
    <section class="hero" style="background-image: url({{ asset('images/ochp.jpg')}}); position: relative;">
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
                               class="link nav__item nav__item--tab live ">{{ __('navbar.mf17')}}</a></li>
                        <li><a href="{{ route('retirementinsurance') }}" data-link="live_page"
                               class="link nav__item nav__item--tab">{{ __('navbar.mf18')}}</a></li>
                        <li><a href="{{ route('covid') }}" data-link="live_page"
                               class="link nav__item nav__item--tab active">{{ __('navbar.mf26')}}</a></li>
                    </ul>
                </nav>
            </div>
        </div>
    </section>
    <br>
    <div class="calculator__block bg-grey entry agentBlock agentHasError" id="section1">
        <h3 class="calculator__title col--12-12 p-3">
            @if($checkServerResult == '0')
                {{ __('navbar.plug_text_esbd') }}
            @elseif($checkServerResult == '1')
                {{ __('navbar.plug_text_server') }}
            @elseif($checkServerResult == '2')
                {{ __('navbar.plug_text_kias') }}
            @endif
        </h3>
    </div>
        <style>
            .removejust {
                display: none;
            }

            section.nav-section {
                display: none;
            }

            .card-body {
                display: none;
            }
        </style>

        <!-- Начало Скрипта -->

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://unpkg.com/imask"></script>
        <script type="text/javascript"></script>
        </main>

@endsection
