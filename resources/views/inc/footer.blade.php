<footer class="footer">
    <div class="container">
        <div class="grid">
            <div class="col col--3-12">
                <nav class="nav nav--footer">
                    <h3 class="nav__title">{{ __('navbar.insur')}}</h3>
                    <ul class="nav__list">
                        <li><a href="{{ route('product')}}" class="link nav__item">{{ __('navbar.mf15')}}</a></li>
                        <li><a href="{{ route('annuitet')}}" class="link nav__item"> {{ __('navbar.mf16')}} </a></li>
                        <li><a href="{{ route('live')}}" class="link nav__item">{{ __('navbar.mf17')}}</a></li>
                        <li><a href="{{ route('retirementinsurance')}}" class="link nav__item">{{ __('navbar.mf18')}}</a></li>

                    </ul>
                </nav>
            </div>
            <div class="col col--3-12">
                <nav class="nav nav--footer">
                    <h3 class="nav__title">{{ __('navbar.aboutus')}}</h3>
                    <ul class="nav__list">
                        <li><a href="{{ route('about.history') }}" class="link nav__item">{{ __('navbar.mf5')}}</a></li>
                        <li><a href="{{ route('about.team') }}" class="link nav__item">{{ __('navbar.mf6')}}</a></li>
                        <li><a href="{{ route('about.akcioneram') }}" class="link nav__item">{{ __('navbar.mf10')}}</a></li>
                        <li><a href="{{ route('about.license',) }}" class="link nav__item">{{ __('navbar.mf7')}}</a></li>
                        <li><a href="{{ route('about.compliance_controller') }}" class="link nav__item">{{ __('navbar.mf11')}}</a></li>
                    </ul>
                </nav>
            </div>
            <div class="col col--6-12">
                <nav class="nav nav--footer">
                    <h3 class="nav__title">{{ __('navbar.mf4')}}</h3>
                    <div class="grid">
                        <div class="col col--6-12">
                            <ul class="nav__list">
                                <li>
                                    <div class="phones dropdown phones--small">
                                        <div class="footer-btn button button--hollow"> <span class="phone">
    <span class="phone__type">

<svg class="icon icon-mobile phone__icon"><use xlink:href="{{ asset('images/sprite.svg#icon-mobile')}}"></use></svg>

      <span>{{ __('cit')}}</span> </span> <span class="phone__number ctcg2 usure">+7 727 244 74 00</span> </span>
                                        </div>

                                    </div>
                                    <!-- end phones-->
                                </li>
                                <li><a href="mailto:call-center@kommesk-omir.kz" class="link nav__item footer__mail">call-center@kommesk-omir.kz</a>
                                </li>
                                <li><a href="{{ route('contacts') }}" class="link nav__item">{{ __('navbar.ho')}}</a></li>
                                <li><a href="{{ route('contacts') }}" class="link nav__item">{{ __('navbar.fil')}}</a></li>
                                <li><a href="{{ route('contacts') }}" class="link nav__item">{{ __('navbar.callb')}}</a></li>
                            </ul>
                        </div>
                        <div class="col col--6-12 footer__lastcol">
                            <nav class="nav nav--social">
                                <div class="nav__list">
                                    <a rel="nofollow" target="_blank" title="vk" alt="vk"
                                       href="https://vk.com/kommesk_omir" class="button button--hollow nav__link">
                                        <svg class="icon icon-vk">
                                            <use xlink:href="{{ asset('images/sprite.svg#icon-vk')}}"></use>
                                        </svg>
                                    </a>
                                    <a rel="nofollow" target="_blank" title="facebook" alt="facebook"
                                       href="https://www.facebook.com/kommesk/" class="button button--hollow nav__link">
                                        <svg class="icon icon-facebook">
                                            <use
                                                xlink:href="{{ asset('images/sprite.svg#icon-facebook')}}"></use>
                                        </svg>
                                    </a>
                                    <a rel="nofollow" target="_blank" title="twitter" alt="twitter"
                                       href="https://twitter.com/kommesk_omir" class="button button--hollow nav__link">
                                        <svg class="icon icon-twitter">
                                            <use
                                                xlink:href="{{ asset('images/sprite.svg#icon-twitter')}}"></use>
                                        </svg>
                                    </a>
                                    <a rel="nofollow" target="_blank" title="instagram" alt="instagram"
                                       href="https://www.instagram.com/kommesk_omir_official/"
                                       class="button button--hollow nav__link">
                                        <svg class="icon icon-instagram">
                                            <use
                                                xlink:href="{{ asset('images/sprite.svg#icon-instagram')}}"></use>
                                        </svg>
                                    </a>

                                    <a rel="nofollow" target="_blank" title="youtube" alt="youtube"
                                       href="https://www.youtube.com/user/Kommeskable/"
                                       class="button button--hollow nav__link">
                                        <svg class="icon icon-instagram">
                                            <use
                                                xlink:href="{{ asset('images/sprite.svg#icon-uoutube')}}"></use>
                                        </svg>
                                    </a>
                                </div>
                            </nav>
                            <div class="copy">
                                <p>??2020 <span class="text-grey">??????????????-????????</span></p></div>
                        </div>
                    </div>
                    <!-- end inner-grid -->
                </nav>
            </div>
        </div>
        <script src="{{ asset('js/dopTOP.js')}}" type="text/javascript"></script>
        <script src="{{ asset('js/dr.php')}}" type="text/javascript"></script>

        <!-- end grid -->
    </div>
</footer>
