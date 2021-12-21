@extends('layouts.general')

@section('content')

    <script>
        //начало скрипта для раздела О компании под меню
        $(document).ready(function () {
            var pageName = new URL(window.location.href).pathname.split('/')[1];
            $.each($('.upper_nav > li > a'), function (k, v) {
                var linkName = $(this).attr('href').split('/')[1];
                if (linkName == pageName)
                    $(this).addClass('active');
            });
            if (pageName == 'annuitet' || pageName == 'live' || pageName == 'retirementinsurance') {
                $("#product").addClass('active');
            }

        });
        $(document).ready(function () {
            $('.link.nav__item').click(function () {
                if ($(this).attr('data-id') == 29) {
                    $('.tab-panels__item').removeClass('active');
                    $("div.tab-panels__item[id='29']").addClass('active');
                } else if ($(this).attr('data-id') == 30) {
                    $('.tab-panels__item').removeClass('active');
                    $("div.tab-panels__item[id='30']").addClass('active');
                } else if ($(this).attr('data-id') == 31) {
                    $('.tab-panels__item').removeClass('active');
                    $("div.tab-panels__item[id='31']").addClass('active');
                }
            });
        });

        $(document).ready(function () {
            $('select.field').on('change', function () {
                // alert( this.value );
                if (this.value == 'team#headOffice') {
                    $('.tab-panels__item').removeClass('active');
                    $("div.tab-panels__item[id='29']").addClass('active');
                } else if (this.value == 'team#board') {
                    $('.tab-panels__item').removeClass('active');
                    $("div.tab-panels__item[id='30']").addClass('active');
                } else if (this.value == 'team#other') {
                    $('.tab-panels__item').removeClass('active');
                    $("div.tab-panels__item[id='31']").addClass('active');
                }
            });
        });



    </script>


    <section class="content" data-tab-component>
        <h1 class="content__title">{{ __('navbar.team')}}</h1>
        <!-- end .about-intro__title -->
        <div class="grid">

            <aside class="col col--3-12">
                <nav class="nav nav--arrows">
                    <div class="nav__select">
                        <select class="field" name="selecter" data-tab-select>
                            <option value="team#headOffice" selected data-id="29">{{ __('navbar.bod') }}</option>
                            <option value="team#board" data-id="30">{{ __('navbar.prav') }}</option>
                            <option value="team#other" data-id="31">{{ __('navbar.od') }}</option>
                        </select>
                    </div>
                    <ul class="nav__list teamSelect" data-tabs>
                        <li>
                            <a href="team#headOffice" data-tab class="link nav__item active"
                               data-id="29">{{ __('navbar.bod') }}</a>
                        </li>
                        <li>
                            <a href="team#board" data-tab class="link nav__item" data-id="30">{{ __('navbar.prav') }}</a>
                        </li>
                        <li>
                            <a href="team#other" data-tab class="link nav__item" data-id="31">{{ __('navbar.od') }}</a>
                        </li>
                    </ul>
                </nav>
            </aside>

            <!-- end .col col--3-12 -->


            <article class="col col--9-12">
                <div class="tab-panels" data-tabs-content>
                    @foreach($articles as $key => $value)
                    <div class="tab-panels__item active activclick" data-tabs-pane id="{{ $value->{'razid'} }}">
                        <div class="persons-list">
                                <div class="persons-list__item">
                                    <div class="person">
                                        <div class="person__wrapper">

                                            <figure class="person-photo">
                                                @if($value->img_ru != '')
                                                <img src="{{ $value->img_ru }}"
                                                                              class="person-photo__image" alt="{{ $value->{'name_ru'} }}">
                                                    <div class="person-photo__back"></div>
                                                @endif
                                            </figure>

                                            <div class="person-info"><h3
                                                    class="person__title">{{ $value->{'name_'.App::getLocale() } }}</h3>
                                                <p class="person__desc">{{ $value->{'head_'.App::getLocale() } }}</p>
                                                <section class="showmore js-showmore" data-show-height="140px"
                                                         data-show-text="{{__('pod') }}" data-hide-text="{{__('hide') }}">
                                                    <article class="article person__article showmore__article">
                                                        <ul>
                                                            {!! $value->{'tex_'.App::getLocale() } !!}
                                                        </ul>
                                                    </article>
                                                </section>
                                            </div>
                                        </div>
                                        <br>
                                    </div>
                                </div>

                        </div>
                        <!-- end .persons-list -->
                    </div>
                    @endforeach
                </div>
            </article>
            <!-- end .col col--9-12 -->
        </div>
        <!-- end .grid -->
    </section>
    <!-- end -->
    </div>
    <!-- end container -->
    </main>
    <!-- end main -->
@endsection
