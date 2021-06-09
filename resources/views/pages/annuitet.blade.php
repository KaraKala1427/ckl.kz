@extends('layouts.general')

@section('content')
            @include('mini_parts.callback')
            <section class="hero" style="background-image: url({{ asset('images/a.jpg')}}); position: relative;">
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
            <div class="grid localgrid">

                <!-- .contacts__mails -->
                <div class="contacts__feedback">

                    <section class="feedback callb1" id="callb1">
                        <h3 class="feedback__title">{{ __('navbar.bc3')}}</h3>
                        <form action="#" method="" id="call-popup">
                            <div class="grid">
                                <input type="hidden" id="frompage" class="field" name="frompage" value="Аннуитетное страхование https://ckl.kz/annuitet">

                                <fieldset class="field-set col col--full" style="">
                                    <label class="field-set__label">{{ __('navbar.bc4')}}</label>
                                    <input  type="text" class="field" onkeyup="showOrHideBlock('fullname_error1','fullname1')" id="fullname1" name="fullname" >

                                    <strong><small id="fullname_error1" class="form-text text-" style="display: none;  color: crimson">Поле ФИО должно быть заполнено!</small></strong>
                                </fieldset>

                                <fieldset class="field-set col col--1-2" style="">
                                    <label class="field-set__label">{{ __('navbar.bc5')}}</label>
                                    <input type="tel"  class="field tel-masked" id="phone-input1" onkeyup="showOrHideBlock('phone_error1','phone-input1')" name="phone" placeholder="Номер мобильного или городского" >
                                    <strong> <small id="phone_error1" class="form-text text-" style="display: none; color: crimson">Поле номер должно быть заполнено!</small></strong>
                                </fieldset>


                                <fieldset class="field-set col col--1-2" style="false">
                                    <label class="field-set__label">Эл. почта</label>
                                    <input type="email" class="field" name="email" id="email1"
                                           onclick="$(this).css('border-color','#ccc')"/></fieldset>

                                <fieldset class="field-set col col--full" style="false">
                                    <textarea class="field" name="qst" value="" id="qst" placeholder="Ваш вопрос" rows="5"></textarea></fieldset>


                                <style>
                                    .localgrid {
                                        width: 100%;
                                        display: flex;
                                        justify-content: center;
                                        align-items: center;
                                    }

                                    .localgrid section {
                                        width: 77%;
                                        margin: 10px auto;
                                    }

                                    .card__image {
                                        width: 80%;
                                        height: 400px;
                                    }

                                    .card__image img {
                                        width: 100%;
                                    }

                                    @media (max-width: 991px) {
                                        .card__image {
                                            width: 80%;
                                            height: 150px;
                                        }

                                    }

                                    .removejust {
                                        display: none;
                                    }
                                </style>

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

                                            $("#call-popup-call-date").val('2020-02-03 11:18');
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
                                        $loading = $("#loading1");
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
                                        $('#submitcallback1').click(function (event) {
                                            event.preventDefault();
                                            // alert('контактный аяах');
                                            var fullname = $("#fullname1").val();
                                            var phone = $("#phone-input1").val();
                                            var email = $('#email1').val();
                                            var frompage = $('#frompage').val();
                                            var qst = $('#qst').val();


                                            $.ajax({
                                                url: "/sendhtmlmail",
                                                type: 'get',
                                                data: {
                                                    fullname: fullname,
                                                    phone: phone,
                                                    email: email,
                                                    qst: qst,
                                                    frompage: frompage

                                                },
                                                beforeSend: function () {
                                                    let a = false;
                                                    if(fullname=='') {
                                                        // alert('Поле ФИО у нас обязательное для заполнения!');
                                                        // $("#fullname").val("ошибка");
                                                        $("#fullname_error1").show();
                                                        a = true;
                                                    }
                                                    if(phone==''){
                                                        $("#phone_error1").show();
                                                        a = true;
                                                    }
                                                    if(a) return false;

                                                    $loading.show();
                                                    $("#fullname_error1").hide();
                                                    $("#phone_error1").hide();
                                                    $('#submitcallback1').hide();

                                                },
                                                complete: function () {
                                                    console.log('ушло сообщение')
                                                    $loading.hide();
                                                    $('#submitcallback1').show();

                                                },
                                                success: function (data) {
                                                    if (data == 'true') {
                                                        $(".callb1").html('<h3 style="color:springgreen">Спасибо за обращение!</h3> С Вами свяжутся по номеру <strong style="color:black;">+7' + phone + '</strong> в указанное в заявке время.');
                                                        dataLayer.push({'event': 'callback_sent'});

                                                        $('#feedbackModal1').css('max-height', '155px');
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
                                            id="submitcallback1">{{ __('navbar.bc8')}}
                                    </button>
                                    <button style="display: none;" class="button button--prime" id="loading1"
                                            disabled="">{{ __('navbar.bc9')}}
                                    </button>
                                </div>
                                <div class="field-set col col--1-2" id="cberror" style="display: none;"><br><br></div>
                            </div>
                        </form>
                    </section>




{{--            <script>--}}


{{--                if($('#contact_form').length > 0){--}}
{{--                    $('#contact_form').validate({--}}
{{--                        rules: {--}}
{{--                            fullname: {--}}
{{--                                required: true,--}}
{{--                            },--}}
{{--                            phone: {--}}
{{--                                required: true,--}}

{{--                            },--}}

{{--                            messages: {--}}
{{--                                required: true--}}
{{--                            },--}}
{{--                        },--}}

{{--                        messages: {--}}
{{--                            fullname: {--}}

{{--                                required: "Поле ФИО должно быть заполнено!",--}}
{{--                            },--}}

{{--                            phone: {--}}

{{--                                required: "Поле номер должно быть заполнено!",--}}
{{--                            },--}}
{{--                        }--}}

{{--                    });--}}
{{--                }--}}
{{--            </script>--}}

                </div>

            </div>
        <!-- end container -->
    </main>
    <!-- end main -->

@endsection
