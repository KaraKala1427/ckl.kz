<body>

<!--[if lt IE 10]>
<p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade
    your browser</a> to improve your experience.</p>
<![endif]-->
<header class="header">
    <div class="container">
        <div class="header__wrapper">
            <div class="header__logo">
                <a href="/" class="logo">
                    <img src="{{ asset('images/logonew.png') }}" srcset="{{ asset('images/logonew.png') }}"
                         alt="Коммеск Омир"
                         class="logo_image" style='width:204px;'/>
                </a>
            </div>

            <!-- end header logo -->
            <div class="header__menu">
                <x-language type="desktop"></x-language>
                <div class="header__menu-item">
                    <div class="phones dropdown" tabindex="0">
                        <div class="dropdown__toggle button button--hollow">
                            <span class="phone">
                                <span class="phone__type">
                                <svg class="icon icon-mobile phone__icon"><use
                                        xlink:href="{{ asset('images/sprite.svg#icon-landline')}}"></use></svg>
                                <span>Городской</span>
                                </span>
                                <span class="phone__number">+7 727 244-74-00</span>
                            </span>
                        </div>
                        <div class="dropdown__menu  phones__menu" tabindex="1">
                            <div class="dropdown__content">
                                <ul class="dropdown__list phones__list">
                                    <li class="phones__item">
                                        <a href="tel:+77012447400">
                                          <span class="phone">
                                            <span class="phone__type">
                                            <svg class="icon icon-landline phone__icon"><use
                                                    xlink:href="{{ asset('images/sprite.svg#icon-mobile')}}"></use></svg>
                                              <span>Мобильный</span>
                                            </span>
                                            <span class="phone__number ctcg2">+7 701 244 74 00</span>
                                          </span>
                                        </a>
                                    </li>

                                    <li class="phones__item">
                                        <a href="tel:+77272447400">
                                          <span class="phone">
                                            <span class="phone__type">
                                                <svg class="icon icon-landline phone__icon"><use
                                                        xlink:href="{{ asset('images/sprite.svg#icon-landline')}}"></use></svg>
                                                      <span>Call-центр</span>
                                            </span>
                                              <span class="phone__number ctcg2">+7 727 244 74 00</span>
                                          </span>
                                        </a>
                                    </li>


                                </ul>
                            </div>
                        </div>
                    </div>
                    <!-- end phones-->
                </div>

                <div class="header__menu-item" style="display: block;">
                    <a href="#feedbackModal" data-izimodal-open="#feedbackModal" data-izimodal-transitionin="fadeInDown"
                       class="link">Обратный звонок
                    </a>
                </div>

                <div class="header__menu-item">
                    <div class="dropdown dropdown--light dropdown--right  city">
                        <!-- В диве ниже стоит временный атрибут style, чтобы решить проблему ширины блока. В будущем, возможно, придется убрать.-->
                        <div class="dropdown__toggle button button--hollow ctcg citiest citiest__main"
                             style="width: 163px; font-size: 16px;" id="city-label">&nbsp;
                        </div>

                        <div class="dropdown__menu cityger">
                            <ul class="dropdown__list myid">
                                <li><a   georegion="aktau" georegionkk=" " georegionru="Актау"
                                       value=Актау tel="+7 727 244 74 00" id="forclickaktau" data-current="1">Актау</a>
                                </li>
                                <li><a georegion="aktobe" georegionkk=" " georegionru="Актобе"
                                       value=Актобе tel="+7 727 244 74 00" id="forclickaktobe"
                                       data-current="0">Актобе</a></li>
                                <li><a georegion="almaty" georegionkk=" " georegionru="Алматы"
                                       value=Алматы tel="+7 727 244 74 00" id="forclickalmaty"
                                       data-current="0">Алматы</a></li>
                                <li><a georegion="atyrau" georegionkk=" " georegionru="Атырау"
                                       value=Атырау tel="+7 727 244 74 00" id="forclickatyrau"
                                       data-current="0" >Атырау</a></li>
                                <li><a georegion="karaganda" georegionkk=" " georegionru="Караганда"
                                       value=Караганда  tel="+7 727 244 74 00" id="forclickkaraganda" data-current="0">Караганда</a>
                                </li>
                                <li><a georegion="kokshetau" georegionkk=" " georegionru="Кокшетау"
                                       value=Кокшетау tel="+7 727 244 74 00" id="forclickkokshetau" data-current="0" >Кокшетау</a>
                                </li>
                                <li><a georegion="kostanay" georegionkk=" " georegionru="Костанай"
                                       value=Костанай tel="+7 727 244 74 00" id="forclickkostanay" data-current="0" >Костанай</a>
                                </li>
                                <li><a georegion="kyzylorda" georegionkk=" " georegionru="Кызылорда"
                                       value=Кызылорда tel="+7 727 244 74 00" id="forclickkyzylorda" data-current="0" >Кызылорда</a>
                                </li>
                                <li><a georegion="nur-sultan" georegionkk=" " georegionru="Нур-Султан"
                                       value=Нур-Султан tel="+7 727 244 74 00" id="forclicknur-sultan" data-current="0" >Нур-Султан</a>
                                </li>
                                <li><a georegion="pavlodar" georegionkk=" " georegionru="Павлодар"
                                       value=Павлодар tel="+7 727 244 74 00" id="forclickpavlodar" data-current="0">Павлодар</a>
                                </li>
                                <li><a georegion="petropavlovsk" georegionkk=" " georegionru="Петропавловск"
                                       value=Петропавловск tel="+7 727 244 74 00" id="forclickpetropavlovsk"
                                       data-current="0" >Петропавловск</a></li>
                                <li><a georegion="semey" georegionkk=" " georegionru="Семей"
                                       value=Семей tel="+7 727 244 74 00" id="forclicksemey" data-current="0" >Семей</a>
                                </li>
                                <li><a georegion="taldykorgan" georegionkk=" " georegionru="Талдыкорган"
                                       value=Талдыкорган tel="+7 727 244 74 00" id="forclicktaldykorgan"
                                       data-current="0" >Талдыкорган</a></li>
                                <li><a georegion="taraz" georegionkk=" " georegionru="Тараз"
                                       value=Тараз tel="+7 727 244 74 00" id="forclicktaraz" data-current="0" >Тараз</a>
                                </li>
                                <li><a georegion="turkestan" georegionkk=" " georegionru="Туркестан"
                                       value=Туркестан tel="+7 727 244 74 00" id="forclickturkestan" data-current="0">Туркестан</a>
                                </li>
                                <li><a georegion="ural-sk" georegionkk=" " georegionru="Уральск"
                                       value=Уральск tel="+7 727 244 74 00" id="forclickural-sk" data-current="0" >Уральск</a>
                                </li>
                                <li><a georegion="ust--kamenogorsk" georegionkk=" " georegionru="Усть-Каменогорск"
                                       value=Усть-Каменогорск tel="+7 727 244 74 00" id="forclickust--kamenogorsk"
                                       data-current="0" >Усть-Каменогорск</a></li>
                                <li><a georegion="shymkent" georegionkk=" " georegionru="Шымкент"
                                       value=Шымкент tel="+7 727 244 74 00" id="forclickshymkent" data-current="0" >Шымкент</a>
                                </li>
                            </ul>
                        </div>
                        <!-- end dropdown-menu -->
                    </div>
                    <!-- end dropdown -->
                </div>
                <!--  <div class="header__menu-item"> <a href="#searchModal" data-izimodal-open="#searchModal" data-izimodal-transitionin="fadeInDown" class="link Search__toggle">

        <svg class="icon icon-search"><use xlink:href="/templates/assets/images/sprite.svg#icon-search"></use></svg>

                  </a> </div> -->


                <!-- registration code -->
                <!--     <div class="header__menu-item header__menu-item--user" style="height: 27px;"> <a href="https://cabinet.kommesk.kz/" alt="Личный кабинет" title="Личный кабинет" class="link"><svg class="icon icon-cabinet"><use xlink:href="/templates/assets/images/sprite.svg#icon-user" ></use></svg></a> </div> -->


            </div>
            <!--  end header menu -->

            <div class="header__mobile">
                <button data-izimodal-open="#phonesModal" class="button button--icon button--square ">
                    <svg class="icon icon-landline">
                        <use xlink:href="{{ asset('images/sprite.svg#icon-landline')}}"></use>
                    </svg>
                </button>
                <button class="button button--icon button--square js-menu-toggle">
                    <svg class="icon icon-menu">
                        <use xlink:href="{{ asset('images/sprite.svg#icon-menu')}}"></use>
                    </svg>
                </button>
                <div class="menu-mobile">
                    <div class="menu-mobile__top">
                        <!-- <div class="menu-mobile__top-item"> <a href="#searchModal" data-izimodal-open="#searchModal" class="link Search__toggle ">
           <svg class="icon icon-search"><use xlink:href="/templates/assets/images/sprite.svg#icon-search"></use></svg>
           </a> </div> -->
                        <!-- .menu-mobile__top-item -->
                        <div class="menu-mobile__top-item" style="display:none;">
                            <div class="dropdown dropdown--light dropdown--right ">
                                <div class="dropdown__toggle button button--hollow"
                                     style="width: 137px;">Алматы
                                </div>


                                <div class="dropdown__menu cityger">
                                    <ul class="dropdown__list myid">
                                        <li><a  georegion="aktau" georegionkk=" " georegionru="Актау"
                                               value=Актау tel="+7 727 244 74 00" id="forclickaktau" data-current="1">Актау</a>
                                        </li>
                                        <li><a  georegion="aktobe" georegionkk=" " georegionru="Актобе"
                                               value=Актобе tel="+7 727 244 74 00" id="forclickaktobe" data-current="0">Актобе</a>
                                        </li>
                                        <li><a georegion="almaty" georegionkk=" " georegionru="Алматы"
                                               value=Алматы tel="+7 727 244 74 00" id="forclickalmaty" data-current="0">Алматы</a>
                                        </li>
                                        <li><a georegion="atyrau" georegionkk=" " georegionru="Атырау"
                                               value=Атырау tel="+7 727 244 74 00" id="forclickatyrau" data-current="0">Атырау</a>
                                        </li>y
                                        <li><a georegion="karaganda" georegionkk=" " georegionru="Караганда"
                                               value=Караганда tel="+7 727 244 74 00" id="forclickkaraganda"
                                               data-current="0">Караганда</a></li>
                                        <li><a georegion="kokshetau" georegionkk=" " georegionru="Кокшетау"
                                               value=Кокшетау tel="+7 727 244 74 00" id="forclickkokshetau"
                                               data-current="0">Кокшетау</a></li>
                                        <li><a georegion="kostanay" georegionkk=" " georegionru="Костанай"
                                               value=Костанай tel="+7 727 244 74 00" id="forclickkostanay"
                                               data-current="0">Костанай</a></li>
                                        <li><a georegion="kyzylorda" georegionkk=" " georegionru="Кызылорда"
                                               value=Кызылорда tel="+7 727 244 74 00" id="forclickkyzylorda"
                                               data-current="0">Кызылорда</a></li>
                                        <li><a georegion="nur-sultan" georegionkk=" " georegionru="Нур-Султан"
                                               value=Нур-Султан tel="+7 727 244 74 00" id="forclicknur-sultan"
                                               data-current="0">Нур-Султан</a></li>
                                        <li><a georegion="pavlodar" georegionkk=" " georegionru="Павлодар"
                                               value=Павлодар tel="+7 727 244 74 00" id="forclickpavlodar"
                                               data-current="0">Павлодар</a></li>
                                        <li><a georegion="petropavlovsk" georegionkk=" " georegionru="Петропавловск"
                                               value=Петропавловск tel="+7 727 244 74 00" id="forclickpetropavlovsk"
                                               data-current="0">Петропавловск</a></li>
                                        <li><a georegion="semey" georegionkk=" " georegionru="Семей"
                                               value=Семей tel="+7 727 244 74 00" id="forclicksemey" data-current="0">Семей</a>
                                        </li>
                                        <li><a georegion="taldykorgan" georegionkk=" " georegionru="Талдыкорган"
                                               value=Талдыкорган tel="+7 727 244 74 00" id="forclicktaldykorgan"
                                               data-current="0">Талдыкорган</a></li>
                                        <li><a georegion="taraz" georegionkk=" " georegionru="Тараз"
                                               value=Тараз tel="+7 727 244 74 00" id="forclicktaraz" data-current="0">Тараз</a>
                                        </li>
                                        <li><a georegion="turkestan" georegionkk=" " georegionru="Туркестан"
                                               value=Туркестан tel="+7 727 244 74 00" id="forclickturkestan"
                                               data-current="0">Туркестан</a></li>
                                        <li><a georegion="ural-sk" georegionkk=" " georegionru="Уральск"
                                               value=Уральск tel="+7 727 244 74 00" id="forclickural-sk"
                                               data-current="0">Уральск</a></li>
                                        <li><a georegion="ust--kamenogorsk" georegionkk=" "
                                               georegionru="Усть-Каменогорск"
                                               value=Усть-Каменогорск tel="+7 727 244 74 00"
                                               id="forclickust--kamenogorsk" data-current="0">Усть-Каменогорск</a></li>
                                        <li><a georegion="shymkent" georegionkk=" " georegionru="Шымкент"
                                               value=Шымкент tel="+7 727 244 74 00" id="forclickshymkent"
                                               data-current="0">Шымкент</a></li>
                                    </ul>
                                </div>
                                <!-- end dropdown-menu -->
                            </div>
                            <!-- end dropdown -->
                        </div>
                        <!-- .menu-mobile__top-item -->
                        <!-- <div class="menu-mobile__top-item"><a href="https://cabinet.kommesk.kz/" alt="Личный кабинет" title="Личный кабинет" class="link"><svg class="icon icon-cabinet"><use xlink:href="/templates/assets/images/sprite.svg#icon-user"></use></svg></a> </div> -->
                        <!-- <div class="menu-mobile__top-item"><a href="https://cabinet.kommesk.kz/" class="link">Войти</a> </div> -->
                        <!-- .menu-mobile__top-item -->
                    </div>

                    <!-- .menu-mobile__top -->
                    <div class="menu-mobile__body">
                        <nav class="nav nav--menu " id="nav__list">
                            <ul class="nav__list nav__list--prime">
                                <ul class="nav__list nav__list--second">
                                    <li style="margin-bottom: 0; padding-top: 5px;">
                                        <a href="{{ route('product' )}}"
                                           class="link nav__item nav__item--tab "
                                           style="font-size: 21px">{{ __('navbar.mf1')}}</a>
                                    </li>
                                    <li>
                                        <a href="{{ route('about.history')}}"
                                           class="link nav__link nav__fold ">
                                            <span class="nav__arrow"></span>
                                            {{ __('navbar.mf2')}}
                                        </a>
                                        <ul class="nav__list">
                                            <li><a href="{{ route('about.history') }}"
                                                   class="link nav__item">{{ __('navbar.mf5')}}</a></li>
                                            <li><a href="{{ route('about.team') }}"
                                                   class="link nav__item">{{ __('navbar.mf6')}}</a></li>
                                            <li><a href="{{ route('about.license') }}"
                                                   class="link nav__item ">{{ __('navbar.mf7')}}</a></li>
                                            <li><a href="{{ route('about.financial_statements') }}"
                                                   class="link nav__item ">{{ __('navbar.mf8')}}</a></li>
                                            <li><a href="{{ route('about.corporate_events') }}"
                                                   class="link nav__item ">{{ __('navbar.mf9')}}</a></li>
                                            <li><a href="{{ route('about.akcioneram') }}"
                                                   class="link nav__item ">{{ __('navbar.mf10')}}</a></li>
                                            <li><a href="{{ route('about.compliance_controller') }}"
                                                   class="link nav__item ">{{ __('navbar.mf11')}}</a></li>
                                            <li>
                                                <a href="{{ route('about.informaciya_dlya_insayderov') }}"
                                                   class="link nav__item ">{{ __('navbar.mf12')}}</a></li>
                                            <li><a href="{{ route('about.tarify') }}"
                                                   class="link nav__item ">{{ __('navbar.mf13')}}</a></li>
                                            <li><a href="{{ route('about.agents') }}"
                                                   class="link  nav__item">{{ __('navbar.mf21')}}</a></li>
                                            <!--<li><a href="/about/association_participation" class="link  nav__item">Участие в ассоциациях</a></li>-->
                                            <li><a href="{{ route('about.requisites') }}"
                                                   class="link  nav__item">{{ __('navbar.mf14')}}</a></li>
                                        </ul>
                                        <!-- .nav__list -->
                                    </li>

                                    <li>
                                        <a href="{{ route('press')}}"
                                           class="link nav__item nav__item--tab">{{ __('navbar.mf3')}}</a>
                                    </li>


                                    <li>
                                        <a href="{{ route('contacts')}}"
                                           class="link nav__item nav__item--tab">{{ __('navbar.mf4')}}</a>
                                    </li>


                                </ul>
                                <!-- .nav__list -->
                                </li>
                            </ul>
                            <!-- .nav__list -->
                        </nav>
                        <!-- .nav nav--menu -->
                        <nav class="nav nav--lang">
                            <ul class="nav__list">
                                <x-language type="mobile"></x-language>
                            </ul>
                            <!-- .nav__list -->
                        </nav>
                        <!-- .nav nav--lang -->
                    </div>
                    <!-- .menu-mobile__body -->
                </div>
                <!-- .menu-mobile -->

                <div id="phonesModal" class="modal phones__modal" data-modal>
                    <button data-izimodal-close="" class="modal__close">
                        <svg class="icon icon-close">
                            <use xlink:href="{{ asset('images/sprite.svg#icon-close')}}"></use>
                        </svg>
                    </button>

                    <section class="phones phones__block">
                        <h3 class="phones__title">Связаться с нами</h3>
                        <ul class="phones__list">
                            <li class="phones__item">
                                <a href="tel:+77012447400">
                                        <span class="phone">
                                            <span class="phone__type">
                                                <svg class="icon icon-mobile phone__icon"><use xlink:href="{{ asset('images/sprite.svg#icon-mobile')}}"></use></svg>
                                                <span>мобильный</span>
                                            </span>
                                            <span class="phone__number">+7 701 244-74-00</span>
                                        </span>
                                </a>
                            </li>

                            <li class="phones__item ctadnum">
                                <a href="tel:+77272447400">
                                    <span class="phone">
                                        <span class="phone__type">
                                            <svg class="icon icon-landline phone__icon"><use xlink:href="{{ asset('images/sprite.svg#icon-landline')}}"></use></svg>
                                            <span>Call-центр</span>
                                        </span>
                                        <span class="phone__number">+7 727 244 74 00</span>

                                    </span>
                                </a>
                            </li>

                        </ul>
                        <div class="header__menu-item" style="display: block;">
                            <a href="#feedbackModal" data-izimodal-open="#feedbackModal" data-izimodal-transitionin="fadeInDown"
                               class="button button--hollow button--round">Обратный звонок
                            </a>
                        </div>
{{--                           <div class="phones__buttons"> <a href="https://api.whatsapp.com/send?phone=77777447400" class="button button--hollow button--round">--}}
{{--           <svg class="icon icon-whatsapp phone__icon"><use xlink:href="/templates/assets/images/sprite.svg#icon-whatsapp"></use></svg>--}}
{{--            Написать в WhatsApp</a>--}}
{{--                          .button button--hollow <a href="history.html#feedbackModal" data-izimodal-open="#feedbackModal" data-izimodal-close class="button button--hollow button--round">Обратная связь</a>-->--}}
{{--                         .button button--hollow--}}
                    </section>
                </div>
                <!-- .phones__buttons -->
                </section>
            </div>
        </div>
        <!-- .header__mobile -->

    </div>
    <!-- end header wrapper -->

    </div>
</header>


<main class="main">

    <div class="container">

        <nav class="nav nav--tabs adaptive_menu">
            <ul class="nav__list " id="nav__list">
                <li><a href="{{ route('product') }}" class="link nav__item nav__item--tab "
                       id='product'>{{ __('navbar.mf1')}}</a></li>
                <li><a href="{{ route('about.history') }}"
                       class="link nav__item nav__item--tab" id='aboutt'>{{ __('navbar.mf2')}}</a></li>
                <li><a href="{{ route('press', [1]) }}"
                       class="link nav__item nav__item--tab " id='presst'>{{ __('navbar.mf3')}}</a></li>
                <li><a href="{{ route('contacts') }}"
                       class="link nav__item nav__item--tab" id='contactst'>{{ __('navbar.mf4')}}</a></li>
                <li><a href="{{ route('checkpolicy') }}"
                       class="link nav__item nav__item--tab" id='checkpolicyt'>{{ __('navbar.mf33')}}</a></li>
            </ul>

        </nav>

        <section class="nav-section" id="nav__list">
            <nav class="nav nav--sub nav--multiline removejust adaptive_menu">
                <ul class="nav__list remind" id="nav__list" style="margin-left: 10px">
                    <li><a href="{{ route('about.history') }}" class="link nav__item"
                           id="history">{{ __('navbar.mf5')}}</a>
                    </li>
                    <li><a href="{{ route('about.team') }}" class="link nav__item"
                           id="team">{{ __('navbar.mf6')}}</a></li>
                    <li><a href="{{ route('about.license') }}" class="link nav__item "
                           id="license">{{ __('navbar.mf7')}}</a>
                    </li>
                    <li><a href="{{ route('about.financial_statements') }}" class="link nav__item "
                           id="financial_statements">{{ __('navbar.mf8')}}</a></li>
                    <li><a href="{{ route('about.corporate_events') }}" class="link nav__item "
                           id="corporate_events">{{ __('navbar.mf9')}}</a></li>
                    <li><a href="{{ route('about.akcioneram') }}"
                           class="link nav__item " id="akcioneram">{{ __('navbar.mf10')}}</a></li>
                    <li><a href="{{ route('about.compliance_controller') }}"
                           class="link nav__item " id="compliance_controller">{{ __('navbar.mf11')}}</a></li>
                    <li><a href="{{ route('about.informaciya_dlya_insayderov') }}"
                           class="link nav__item " id="informaciya_dlya_insayderov">{{ __('navbar.mf12')}}</a></li>
                    <li><a href="{{ route('about.tarify') }}" class="link nav__item "
                           id="tarify">{{ __('navbar.mf13')}}</a></li>
                    <li><a href="{{ route('about.agents') }}" class="link  nav__item"
                           id="agents">{{ __('navbar.mf21')}}</a>
                    </li>
                    <!--<li><a href="/about/association_participation" class="link  nav__item">Участие в ассоциациях</a></li>-->
                    <li><a href="{{ route('about.requisites') }}"
                           class="link  nav__item" id="requisites">{{ __('navbar.mf14')}}</a></li>
                    <li><a href="{{ route('about.security') }}"
                           class="link  nav__item" id="security">{{ __('navbar.mf23')}}</a></li>
                    <li><a href="{{ route('about.clients-and-rec') }}"
                           class="link  nav__item" id="clients">{{ __('navbar.mf24')}}</a></li>
                </ul>
            </nav>
        </section>


        <div id="feedbackModal" class="modal feedback__modal iziModal visibility" data-modal="" aria-hidden="false"
             aria-labelledby="feedbackModal" role="dialog"
             style="z-index: 999; border-radius: 5px; display: none; height: 155px;">
            <div class="iziModal-wrap" style="height: auto;">
                <div class="iziModal-content" style="padding: 0px;">
                    <button data-izimodal-close="" class="modal__close">
                        <svg class="icon icon-close">
                            <use xlink:href="{{ asset('images/sprite.svg#icon-close')}}"></use>
                        </svg>
                    </button>
                    <section class="feedback callb" id="callb">
                        <h3 class="feedback__title">{{ __('navbar.bc3')}}</h3>
                        <form action="#" method="" id="call-popup">

                            <div class="grid">

                                <fieldset class="field-set col col--full" style="">
                                    <label class="field-set__label">{{ __('navbar.bc4')}}</label>
                                    <input  type="text" onkeypress="return /[a-zA-z\u0400-\u04FF ]/i.test(event.key)" class="field" id="fullname" name="fullname" onkeyup="showOrHideBlock('fullname_error','fullname')" >

                                    <strong><small id="fullname_error" class="form-text text-" style="display: none;  color: crimson">Вы не указали как вас зовут</small></strong>
                                </fieldset>

                                <fieldset class="field-set col col--full" style="">
                                    <label class="field-set__label">{{ __('navbar.bc5')}}</label>
                                    <input type="tel"  class="field tel-masked" id="phone-input" name="phone" onkeyup="showOrHideBlock('phone_error','phone-input')" placeholder="" >
                                    <strong> <small id="phone_error" class="form-text text-" style="display: none; color: crimson">Вы не указали телефон</small></strong>
                                </fieldset>



                                <script>

                                    function showOrHideBlock(errorBlock,manipulationBlock){
                                        $('#'+errorBlock).hide();
                                    }


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
                                    //конец скрипта для раздела О компании под меню

                                    //начало скрипта для обратного звонка
                                    $(document).ready(function () {
                                        function calldate2312() {
                                            var today1 = new Date();
                                            let month,day,minutes;
                                            if ((today1.getMonth()+1) < 10) {
                                                month = '0' + today1.getMonth()+1;
                                            }
                                            else month = today1.getMonth()+1;
                                            if ((today1.getDate()) < 10) {
                                                day = '0' + today1.getDate();
                                            }
                                            else day = today1.getMonth()+1;
                                            if( today1.getMinutes() < 10){
                                                minutes = '0' + today1.getMinutes();
                                            }
                                            else minutes = today1.getMinutes();
                                            var now = today1.getFullYear()+'-'+ month +'-' + day + ' ' + today1.getHours()+':' + minutes;
                                            $("#call-popup-call-date").val(now);
                                            $("#call-popup-call-date").closest('fieldset').addClass('has-success');

                                        }

                                        setTimeout(calldate2312, 2000);

                                        /* Скрипты для формы Обратного звонка */
                                        window.onload = function () {
                                            // Зададим стартовую дату
                                            var start = new Date(),
                                                prevDay,
                                                startHours = 9;
                                            // 09:00
                                            start.setHours(9);
                                            start.setMinutes(0);
                                            // Если сегодня суббота или воскресенье - 10:00
                                            if ([6, 0].indexOf(start.getDay()) != -1) {
                                                start.setHours(10);
                                                startHours = 10
                                            }
                                            var dp = $('.modal [data-callback-time]').data('datepicker');
                                            dp.update({
                                                minDate: start,
                                                startDate: start,
                                                minHours: startHours,
                                                maxHours: 18,
                                                autoClose: true,
                                                onSelect: function (fd, d, picker) {
                                                    // Ничего не делаем если выделение было снято
                                                    if (!d) return;
                                                    var day = d.getDay();
                                                    // Обновляем состояние календаря только если была изменена дата
                                                    if (prevDay != undefined && prevDay == day) return;
                                                    prevDay = day;
                                                    // Если выбранный день суббота или воскресенье, то устанавливаем
                                                    // часы для выходных, в противном случае восстанавливаем начальные значения
                                                    if (day == 6 || day == 0) {
                                                        picker.update({
                                                            minHours: 10,
                                                            maxHours: 16
                                                        })
                                                    } else {
                                                        picker.update({
                                                            minHours: 9,
                                                            maxHours: 18
                                                        })
                                                    }
                                                }
                                            })


                                        }

                                        var $loading = $("#loading");
                                        /* Подсветка Фио зеленым при заполнении */
                                        $('input[name="fullname"]').keyup(function () {
                                            if ($(this).val().length > 1) {
                                                $(this).closest('fieldset').addClass('has-success');
                                                $(this).closest('fieldset').removeClass('has-error');
                                            } else {
                                                $(this).closest('fieldset').removeClass('has-success');
                                            }
                                        });
                                        $('input[name="phone"]').keyup(function () {
                                            if ($(this).val().length == 10) {
                                                $(this).closest('fieldset').addClass('has-success');
                                                $(this).closest('fieldset').removeClass('has-error');
                                            } else {
                                                $(this).closest('fieldset').removeClass('has-success');
                                            }
                                        });

                                        /*Post запрос Обратного звонка с условиями*/
                                        $('#submitcallback').click(function (event) {
                                            event.preventDefault();
                                            var fullname = $("#fullname").val();
                                            var phone = $("#phone-input").val();
                                            $.ajax({
                                                url: "/sendhtmlemail",
                                                type: 'get',
                                                data: {
                                                    fullname: fullname,
                                                    phone: phone,
                                                },
                                                beforeSend: function () {
                                                    let a = false;
                                                    if(fullname=='') {
                                                        $("#fullname_error").show();
                                                        a = true;
                                                    }
                                                    if(phone==''){
                                                        $("#phone_error").show();
                                                        a = true;
                                                    }
                                                    if(a) return false;

                                                    $loading.show();
                                                    $("#fullname_error").hide();
                                                    $("#phone_error").hide();
                                                    $('#submitcallback').hide();

                                                },
                                                complete: function () {
                                                    $loading.hide();
                                                    $('#submitcallback').show();

                                                },
                                                success: function (data) {
                                                    if (data == 'true') {
                                                        $(".callb1").html('<h3 style="color:springgreen">Спасибо за обращение,</h3> С Вами свяжутся по номеру <strong style="color:black;">+7' + phone + '</strong>. Обычно мы реагируем оперативно, но если сегодня выходной, то мы перезвоним Вам на следующий рабочий день!');
                                                        dataLayer.push({'event': 'callback_sent'});
                                                        $('#feedbackModal').css('max-height', '155px');
                                                    } else {
                                                        $("#cberror").html(data);
                                                        $("#cberror").fadeIn(1500);
                                                        $('#fullname').css("border-color", "#f7b4b4");
                                                        $('#phone-input').css("border-color", "#f7b4b4");
                                                    }

                                                },



                                            });
                                        });
                                    });

                                </script>
                                <div class="col col--full">
                                    <button type="submit" class="button button--prime"
                                            id="submitcallback">{{ __('navbar.bc8')}}
                                    </button>
                                    <button style="display: none;" class="button button--prime" id="loading"
                                            disabled="">{{ __('navbar.bc9')}}
                                    </button>
                                </div>
                                <div class="field-set col col--1-2" id="cberror" style="display: none;"><br><br></div>
                            </div>
                        </form>
                    </section>
                </div>
            </div>
        </div>








