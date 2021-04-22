@extends('layouts.general')
@section('content')
            <section class="hero" style="background-image: url({{ asset('images/pa.jpg')}}); position: relative;">
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
                                <li><a href="{{ route('product', app()->getLocale())}}" data-link="hcp_page"
                                       class="link nav__item nav__item--tab ">{{ __('mf15')}}</a></li>
                                <li><a href="{{ route('annuitet', app()->getLocale()) }}" data-link="ann_page"
                                       class="link nav__item nav__item--tab">{{ __('mf16')}}</a></li>
                                <li><a href="{{ route('live', app()->getLocale()) }}" data-link="live_page"
                                       class="link nav__item nav__item--tab live ">{{ __('mf17')}}</a></li>
                                <li><a href="{{ route('retirementinsurance', app()->getLocale()) }}" data-link="live_page"
                                       class="link nav__item nav__item--tab active">{{ __('mf18')}}</a></li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </section>
            <br>

            <div class="about_news">


                <div class="article-page__intro">

                    <!-- .promo__period -->
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

                            <section class="article__text">
                                <div>
                                    <p> {!! $article->{'tex_'.App::getLocale()} !!}</p>
                                </div>
                            </section>

                    </article>



                </div>

                <!-- the end page_grind-->
            </div><br><br>
            @endforeach
            <div id="ann_page" class="blocker">

                <section class="faq">
                    <h2 class="faq__title">{{ __('faq')}}</h2>
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
            <div class="grid localgrid">

                <!-- .contacts__mails -->
                <div class="contacts__feedback">
                    <section class="feedback">
                        <h3 class="feedback__title">Обратная связь</h3>

                        <form action="/contacts" id="formdata">
                            <div class="grid">

                                <fieldset class="field-set col col--full" style="false">
                                    <label class="field-set__label">ФИО</label>
                                    <input type="text" class="field" name="name" id="name" value="" placeholder="" onclick="$(this).css('border-color', '#ccc')" />
                                </fieldset>

                                <fieldset class="field-set col col--1-2" style="false">
                                    <label class="field-set__label">Номер телефона</label>
                                    <input type="tel" class="field tel-masked" name="phone" id="phone" value="" placeholder="+7" onclick="$(this).css('border-color','#ccc')" /> </fieldset>

                                <fieldset class="field-set col col--1-2" style="false">
                                    <label class="field-set__label">Эл. почта</label>
                                    <input type="email" class="field" name="email" id="email" onclick="$(this).css('border-color','#ccc')"/> </fieldset>

                                <fieldset class="field-set col col--full" style="false">
                                    <textarea class="field" name="message" value="" id="message"  placeholder="Ваш вопрос" rows="5"></textarea> </fieldset>

                                <div class="col col--full">
                                    <input type="submit" value='Отправить' class="button button--prime" id="submit">

                                </div>
                            </div>
                            <div id="contnote">

                            </div>
                        </form>
                    </section>
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
                .removejust{
                    display: none;
                }
            </style>
            <script>

                $(document).ready(function(){
                    $('#submit').click(function(){
                        $(this).css('transition','ease-out')
                        $(this).addClass('active');
                        setTimeout(function(){
                            $('#submit').addClass('succes');
                        }, 3700);
                    });
                });
                $('#submit').click(function () {
                    var email = $('#email').val ();
                    var name = $('#name').val ();
                    var phone = $('#phone').val ();
                    var message = $('#message').val ();
                    $.ajax({
                        url:   '/contacts/sendmessage',
                        type:  'POST',
                        cache:    false,
                        data:     {'name':name,'phone':phone, 'email':email, 'message':message},
                        dataType: 'html',
                        beforeSend: function () {
                            $('#submit').attr("disabled", "disabled");
                        },
                        success: function(data) {
                            if (data == 'true') {
                                $('#name').val("");
                                $('#phone').val("");
                                $('#email').val("");
                                $('#message').val("");
                                $('#contnote').html("Сообщение отправлено");
                                $("#formdata").reset();
                                $('#email').css ("border-color", "#2cc");
                                $('#message').css ("border-color", "#2cc");
                                $('#phone').css ("border-color", "#2cc");
                                $('#name').css ("border-color", "#2cc");
                            } else {
                                $('#contnote').html(data);
                                $('#email').css ("border-color", "#f7b4b4");
                                $('#message').css ("border-color", "#f7b4b4");
                                $('#phone').css ("border-color", "#f7b4b4");
                                $('#name').css ("border-color", "#f7b4b4");
                            }
                            $('#submit').removeAttr("disabled");
                        }
                    });
                });

            </script>

        </div>
        <!-- end container -->
    </main>
    <!-- end main -->
@endsection
