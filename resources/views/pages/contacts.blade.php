@extends('layouts.general')

@section('content')

    <div class="card-body">
        @if($message = Session::get('success'))
            <div class="alert alert-success">
                <strong>{{$message}}</strong>
            </div>
        @endif
    </div>



    <main class="main">
        <div class="container">
            <div class="contacts">
                <section class=" content">
                    <h3 class="contacts__title content__title">Контакты
                        <div class="contacts__dropdown dropdown dropdown--light">
                            <div class="dropdown__toggle button button--hollow ctcg citiest city_contact"
                                 id="city-label">&nbsp;
                            </div>

                            <div class="dropdown__menu cityger_contact">
                                <ul class="dropdown__list myid">
                                    @foreach($cities as $city)
                                        @if($city->id != 167)
                                        <li>
                                            <a georegion="{{strtolower($city->name_en)}}" georegionkk="	"
                                               georegionru="{{$city->name}}"
                                               value="{{$city->name}}" tel="+7 727 244 74 00"
                                               id="{{strtolower($city->name_en)}}"
                                               data-current="{{$city->name == "Алматы" ? 1 : 0}}">
                                                {{$city->name}}
                                            </a>
                                        </li>
                                        @endif
                                    @endforeach
                                </ul>
                            </div>
                            <!-- end dropdown-menu -->
                        </div> <!-- end dropdown -->
                    </h3>

                    <!-- end  contacts__title -->
                    <div class="grid contacts__grid" data-tab-component>
                        <aside class="contacts__nav" onchange="myScript()">
                            <nav class="nav nav--arrows js-map-nav" data-tabs>

                                <div class="nav__select contacts__select " onchange="myScript()">
                                    <div class="contacts__dropdown dropdown dropdown--light">
                                        <div class="dropdown__toggle button button--hollow mobmainof ">Адреса
                                            офисов продаж
                                        </div>
                                        <div class="dropdown__menu ">
                                            <ul class="dropdown__list myid">

                                                <li style="color: #00ABCE; font-weight: bold; font-size:18px;">Головной
                                                    офис
                                                </li>
                                                <li class="headofficesm selalmaty"><a ofct="Алматы" id="sshow78"
                                                                                      clickdata="show78"
                                                                                      data-geo="43.263035, 76.934910,*+7 727 244 74 10"
                                                                                      class="headoffm hoalmaty" style="

    border-bottom: 1px solid black;
    font-weight: normal;
    padding-bottom: 6px;">Наурызбай батыра,19 </a></li>
                                                <li class="headofficesm selalmaty"
                                                    style="color: #00ABCE; font-weight: bold; font-size:18px;">Центры
                                                    прямых продаж
                                                </li>

                                                <li class="headofficesm selaktau"><a ofct="Актау" id="sshow157"
                                                                                     clickdata="show157"
                                                                                     data-geo="43.647838, 51.153686"
                                                                                     class="headoffm hoaktau ">9-й
                                                        мкр., д. 29</a></li>
                                                <li class="headofficesm selaktobe"><a ofct="Актобе"
                                                                                      id="sshow108"
                                                                                      clickdata="show108"
                                                                                      data-geo="50.300891, 57.151118,*+7 (7132) 547-587"
                                                                                      class="headoffm hoaktobe ">Пацаева,
                                                        6</a></li>
                                                <li class="headofficesm selatyrau"><a ofct="Атырау"
                                                                                      id="sshow110"
                                                                                      clickdata="show110"
                                                                                      data-geo="47.095814, 51.925061"
                                                                                      class="headoffm hoatyrau ">М.Өтемісұлы,
                                                        121</a></li>
                                                <li class="headofficesm selkaraganda"><a ofct="Караганда"
                                                                                         id="sshow111"
                                                                                         clickdata="show111"
                                                                                         data-geo="49.803791, 73.098942"
                                                                                         class="headoffm hokaraganda ">Н.Абдирова,
                                                        17</a></li>
                                                <li class="headofficesm selkokshetau"><a ofct="Кокшетау"
                                                                                         id="sshow112"
                                                                                         clickdata="show112"
                                                                                         data-geo="53.289116, 69.399666"
                                                                                         class="headoffm hokokshetau ">Ауэзова,
                                                        268</a></li>
                                                <li class="headofficesm selkostanay"><a ofct="Костанай"
                                                                                        id="sshow113"
                                                                                        clickdata="show113"
                                                                                        data-geo="53.230187, 63.616713"
                                                                                        class="headoffm hokostanay ">Темирбаева,
                                                        39</a></li>
                                                <li class="headofficesm selkyzylorda"><a ofct="Кызылорда"
                                                                                         id="sshow114"
                                                                                         clickdata="show114"
                                                                                         data-geo="44.846935, 65.502324"
                                                                                         class="headoffm hokyzylorda ">Байтурсынова,
                                                        47</a></li>
                                                <li class="headofficesm selnur-sultan"><a ofct="Нур-Султан"
                                                                                          id="sshow105"
                                                                                          clickdata="show105"
                                                                                          data-geo="51.1464, 71.4235"
                                                                                          class="headoffm honur-sultan ">г.
                                                        Нур-Султан, пр.Кабанбай батыра 6/1, БЦ «Каскад», 9 этаж, офис
                                                        91.</a></li>
                                                <li class="headofficesm selpavlodar"><a ofct="Павлодар"
                                                                                        id="sshow115"
                                                                                        clickdata="show115"
                                                                                        data-geo="52.283423, 76.972836"
                                                                                        class="headoffm hopavlodar ">Естая,
                                                        89</a></li>
                                                <li class="headofficesm selpetropavlovsk"><a
                                                        ofct="Петропавловск" id="sshow116" clickdata="show116"
                                                        data-geo="54.861058, 69.163508"
                                                        class="headoffm hopetropavlovsk ">Батыр Баян, 30</a>
                                                </li>
                                                <li class="headofficesm selsemey"><a ofct="Семей" id="sshow117"
                                                                                     clickdata="show117"
                                                                                     data-geo="50.415406, 80.254907"
                                                                                     class="headoffm hosemey ">Шакерима,
                                                        54</a></li>
                                                <li class="headofficesm seltaldykorgan"><a ofct="Талдыкорган"
                                                                                           id="sshow118"
                                                                                           clickdata="show118"
                                                                                           data-geo="45.015806, 78.374161"
                                                                                           class="headoffm hotaldykorgan ">Шевченко,
                                                        140</a></li>
                                                <li class="headofficesm seltaraz"><a ofct="Тараз" id="sshow119"
                                                                                     clickdata="show119"
                                                                                     data-geo="42.901570, 71.374741"
                                                                                     class="headoffm hotaraz ">Толе
                                                        би, 38</a></li>
                                                <li class="headofficesm selturkestan"><a ofct="Туркестан"
                                                                                         id="sshow109"
                                                                                         clickdata="show109"
                                                                                         data-geo="51.823414, 68.360201"
                                                                                         class="headoffm hoturkestan ">Тауке
                                                        Хан, 246</a></li>
                                                <li class="headofficesm selural-sk"><a ofct="Уральск"
                                                                                       id="sshow120"
                                                                                       clickdata="show120"
                                                                                       data-geo="51.212613, 51.366348"
                                                                                       class="headoffm houral-sk ">Нурсултана
                                                        Назарбаева, 203</a></li>
                                                <li class="headofficesm selust--kamenogorsk"><a
                                                        ofct="Усть-Каменогорск" id="sshow121"
                                                        clickdata="show121" data-geo="49.960349, 82.604844"
                                                        class="headoffm houst--kamenogorsk ">пр.Нурсултана
                                                        Назарбаева,22</a></li>
                                                <li class="headofficesm selshymkent"><a ofct="Шымкент"
                                                                                        id="sshow84"
                                                                                        clickdata="show84"
                                                                                        data-geo="42.316041, 69.608206"
                                                                                        class="headoffm hoshymkent ">Тауке
                                                        хана, 47</a></li>

                                                <li class="headofficesm selalmaty"><a ofct="Алматы"
                                                                                      id="sshow167"
                                                                                      clickdata="show167"
                                                                                      data-geo="43.239484, 76.908110"
                                                                                      class="headoffm headofficessel ">пр.Абая,
                                                        60</a></li>

                                            </ul>
                                        </div>
                                        <!-- end dropdown-menu -->
                                    </div>
                                </div>

                                @foreach($cities as $city)
                                    @if($city->id != 167)
                                        <div class="menuwraper dis{{strtolower($city->name_en)}}"><h4
                                                class="nav__title">Головной офис</h4>
                                            <ul class="nav__list">
                                                <li>
                                                    <a ofct="{{$city->name}}" id="show{{$city->id}}" style="" data-tab
                                                       data-geo="{{$city->head}}"
                                                       class="js-map-toggle link nav__item headoffices">{{$city->article_name}}
                                                    </a>
                                                </li>
                                                @if($city->id == 78)
                                                    <li class="nav__separate">
                                                        <h4 class="nav__title submenu">Центры прямых продаж</h4>
                                                    </li>
                                                    <li class="suboffices_main">
                                                        <a ofct="Алматы" id="show167" style="" data-tab
                                                           data-geo="43.239484, 76.908110"
                                                           class="js-map-toggle link nav__item suboffices">пр.Абая, 60
                                                        </a>
                                                    </li>
                                                @endif
                                            </ul>
                                        </div>
                                    @endif
                                @endforeach


                            </nav>
                        </aside>
                        <!-- .contacts__nav -->
                        <section class="contacts__info">
                            <div class="tab-panels contacts__adress" data-tabs-content>
                                @foreach($cities as $key => $city)
                                    @if($city->id != 167 )
                                        <div class="tab-panels__item headoffices show{{$city->id}}" data-tabs-pane>
                                            <div class="address">
                                                {!! $city->text  !!}
                                            </div>
                                        </div>
                                    @elseif($city->id == 167)
                                        <div class="tab-panels__item suboffices show{{$city->id}}" data-tabs-pane>
                                            <div class="address">
                                                {!! $city->text !!}
                                            </div>
                                        </div>
                                    @else {{null}}
                                    @endif
                                @endforeach

                            </div>
                            <!-- .contacts__info -->

                            <div class="contacts__map map js-map-container" id="map">
                                <div class="map__message">
                                    <svg class="map__icon" xmlns="http://www.w3.org/2000/svg" width="48"
                                         height="65">
                                        <path fill-rule="evenodd" fill="currentColor"
                                              d="M25.014 63.767L24 64.997l-1.014-1.23C21.972 62.648 0 36.582 0 23.828 0 10.739 10.817 0 24 0s23.999 10.739 23.999 23.828c0 12.754-22.084 38.82-22.985 39.939zM24 2.797c-11.718 0-21.183 9.397-21.183 21.031 0 10.293 16.788 31.436 21.183 36.918 4.394-5.482 21.183-26.625 21.183-36.918 0-11.634-9.465-21.031-21.183-21.031zm0 38.595c-9.916 0-18.028-8.054-18.028-17.899S14.084 5.593 24 5.593c9.915 0 18.028 8.055 18.028 17.9 0 9.845-8.113 17.899-18.028 17.899zM24 8.39c-8.338 0-15.211 6.824-15.211 15.103 0 8.278 6.873 15.102 15.211 15.102 8.338 0 15.211-6.824 15.211-15.102C39.211 15.214 32.338 8.39 24 8.39z"/>
                                    </svg>
                                    Офис открылся недавно, <br>карты пока нет
                                </div>
                                <!-- .map__message -->
                            </div>
                            <!-- #map.contacts__map js-map-container -->
                        </section>
                        <!-- .contacts__info -->
                    </div>
                    <!-- .grid contacts__grid -->
                </section>


                <!-- end content -->
                <section class="content">
                    <div class="grid">
                        <dl class="contacts__mails">
                            <dt class="as-h4">Для прессы</dt>
                            <dd><a href="mailto:pressa@kommesk-omir.kz" class="link">pressa@kommesk-omir.kz</a>
                            </dd>
                            <dt class="as-h4">Для отправки предложений</dt>
                            <dd><a href="mailto:marketing@kommesk-omir.kz" class="link">marketing@kommesk-omir.kz</a>
                            </dd>
                            <dt class="as-h4">По всем вопросам</dt>
                            <dd><a href="mailto:almaty@kommesk-omir.kz" class="link">almaty@kommesk-omir.kz</a>
                            </dd>
                            <dd><a href="mailto:call-center@kommesk-omir.kz"
                                   class="link">call-center@kommesk-omir.kz</a>
                            </dd>
                        </dl>


                        <section class="feedback callb1" id="callb1">
                            <h3 class="feedback__title">{{ __('navbar.bc3_1')}}</h3>
                            <form action="#" method="" id="call-popup">
                                <div class="grid">
                                    <input type="hidden" id="frompage" class="field" name="frompage" value="Контакты
                                            https://ckl.kz/contacts">
                                    <fieldset class="field-set col col--full" style="">
                                        <label class="field-set__label">{{ __('navbar.bc4')}}</label>
                                        <input type="text" class="field"
                                               onkeyup="showOrHideBlock('fullname_error1','fullname1')" id="fullname1"
                                               name="fullname">

                                        <strong><small id="fullname_error1" class="form-text text-"
                                                       style="display: none;  color: crimson">Поле ФИО должно быть
                                                заполнено!</small></strong>
                                    </fieldset>

                                    <fieldset class="field-set col col--1-2" style="">
                                        <label class="field-set__label">{{ __('navbar.bc5')}}</label>
                                        <input type="tel" class="field tel-masked" id="phone-input1"
                                               onkeyup="showOrHideBlock('phone_error1','phone-input1')" name="phone"
                                               placeholder="">
                                        <strong> <small id="phone_error1" class="form-text text-"
                                                        style=" display: none; color: crimson">Поле номер должно быть
                                                заполнено!</small></strong>
                                    </fieldset>


                                    <fieldset class="field-set col col--1-2" style="false">
                                        <label class="field-set__label">Эл. почта</label>
                                        <input type="email" class="field" name="email" id="email1" onkeyup="showOrHideBlock('email_error1','email1')">

                                        <strong> <small id="email_error1" class="form-text text-"
                                                        style=" display: none; color: crimson">Неправильный формат почты</small></strong>
                                    </fieldset>

                                    <fieldset class="field-set col col--full" style="">
                                        <textarea class="field" name="qst" value="" id="qst" placeholder="Ваш вопрос" rows="5"></textarea>
                                    </fieldset>


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
                                    <script>
                                        function showOrHideBlock(errorBlock, manipulationBlock) {
                                            $('#' + errorBlock).hide();
                                        }

                                        function validateEmail(email) {
                                            const re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
                                            return re.test(email);
                                        }
                                        var checkNow;
                                        function disableDate(checkBox){
                                            checkNow = checkBox.checked;
                                            var dateElement = document.getElementById('call-popup-call-date1');
                                            dateElement.disabled = checkBox.checked;
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
                                                let month,day;
                                                if ((today1.getMonth()+1) < 10) {
                                                    month = '0' + today1.getMonth()+1;
                                                }
                                                else month = today1.getMonth()+1;
                                                if ((today1.getDate()) < 10) {
                                                    day = '0' + today1.getDate();
                                                }
                                                else day = today1.getMonth()+1;
                                                var now = today1.getFullYear()+'-'+ month +'-' + day + ' ' + today1.getHours()+':'+today1.getMinutes();
                                                $("#call-popup-call-date1").val(now);
                                                $("#call-popup-call-date1").closest('fieldset').addClass('has-success');

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
                                                var fullname = $("#fullname1").val();
                                                var phone = $("#phone-input1").val();
                                                var email = $('#email1').val();
                                                if(!validateEmail(email) && email.length !== 0) {
                                                    $("#email_error1").show();
                                                    return;
                                                }
                                                var callDate = $('#call-popup-call-date1').val();
                                                var callNow;
                                                if (checkNow) {
                                                    callNow = true;
                                                }
                                                else callNow = false;
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
                                                        if (fullname == '') {
                                                            // alert('Поле ФИО у нас обязательное для заполнения!');
                                                            // $("#fullname").val("ошибка");
                                                            $("#fullname_error1").show();
                                                            a = true;
                                                        }
                                                        if (phone == '') {
                                                            $("#phone_error1").show();
                                                            a = true;
                                                        }


                                                        function validate() {
                                                            const $result = $("#result");
                                                            const email = $("#email1").val();
                                                            $result.text("");

                                                            if (validateEmail(email)) {
                                                                console.log('asd');
                                                                $result.text(email + " is valid :)");
                                                                $result.css("color", "green");
                                                            } else {
                                                                console.log('false');
                                                                $result.text(email + " is not valid :(");
                                                                $result.css("color", "red");
                                                            }
                                                            return false;
                                                        }

                                                        $("#email").on("input", validate);

                                                        if (a) return false;



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
                                                            $(".callb1").html('<h3 style="color:springgreen">Спасибо за обращение,</h3> С Вами свяжутся по номеру <strong style="color:black;">+7' + phone + '</strong>. Обычно мы реагируем оперативно, но если сегодня выходной, то мы перезвоним Вам на следующий рабочий день!');
                                                            dataLayer.push({'event': 'callback_sent'});
                                                            //
                                                            // $('#feedbackModal1').css('max-height', '155px');
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
                                    <div class="field-set col col--1-2" id="cberror" style="display: none;"><br><br>
                                    </div>
                                </div>
                            </form>
                        </section>

                </section>
            </div>
            <!-- .contacts__feedback -->
        </div>
        <!-- .grid -->
        </section>
        <!-- .content -->
        </div>
        <!-- .contacts -->
        </div>
        <!-- end container -->
    </main>
    <!-- end main -->
@endsection





