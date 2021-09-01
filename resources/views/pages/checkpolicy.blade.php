@extends('layouts.general')

@section('content')

        <main class="main">
            <div class="container">
                <div class="contacts">
                    <section class="feedback callb1" id="callb1">
        <h3 class="feedback__title">{{ __('navbar.provpol')}}</h3>
        <form action="#" method="" id="call-popup">
            <div class="grid">
                <fieldset class="field-set col col--full" style="">
                    <label class="field-set__label">{{ __('navbar.policycod')}}</label>
                    <input type="text" class="field"
                           onkeyup="showOrHideBlock('code_error','code')" id="code"
                           name="code">

                    <strong><small id="code_error" class="form-text text-"
                                   style="display: none;  color: crimson">Поле должно быть
                            заполнено!</small></strong>
                </fieldset>

                <fieldset class="field-set col col--full" style="">
                    <label class="field-set__label">{{ __('navbar.captch')}}</label>
                    <div class="captcha">
                                <span>{!! captcha_img() !!}</span>

                                <button type="button" class="btn btn-" class="reload" id="reload" style="margin-bottom: 24px; color: #00abcd; font-size:25px">
                                    &#x21bb;
                                </button>
                    </div>
                    <input  type="text"  class="field" placeholder=""
                    onkeyup="showOrHideBlock('captcha_error','captcha')" id="captcha"
                    name="captcha">

                <strong><small id="captcha_error" class="form-text text-"
                               style="display: none;  color: crimson">Не пройдена капча
                       </small></strong>

                </fieldset>

                <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
                <script type="text/javascript">
                    $('#reload').click(function () {
                        $.ajax({
                            type: 'GET',
                            url: 'reload-captcha',
                            success: function (data) {
                                $(".captcha span").html(data.captcha);
                            }
                        });
                    });

                </script>

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
                <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
                <script type="text/javascript">
                    $('#reload').click(function () {
                        $.ajax({
                            type: 'GET',
                            url: 'reload-captcha',
                            success: function (data) {
                                $(".captcha span").html(data.captcha);
                            }
                        });
                    });

                </script>

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
                        $('input[name="code"]').keyup(function () {
                            if ($(this).val().length > 1) {
                                $(this).closest('fieldset').addClass('has-success');
                                $(this).closest('fieldset').removeClass('has-error');
                            } else {
                                $(this).closest('fieldset').removeClass('has-success');
                            }
                        });
                        $('input[name="captcha"]').keyup(function () {
                            if ($(this).val().length == 5) {
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
                            var code = $("#code").val();
                            var captcha = $("#captcha").val();

                            $.ajax({
                                url: "/captcha-validation",
                                type: 'get',
                                data: {
                                    code: code,
                                    captcha: captcha,
                                },
                                beforeSend: function () {
                                    if (code == '') {
                                        // alert('Поле ФИО у нас обязательное для заполнения!');
                                        // $("#fullname").val("ошибка");
                                        $("#code_error").show();
                                        return false;
                                    }
                                    if (captcha == '') {
                                        $("#captcha_error").show();
                                        return false
                                    }

                                    $loading.show();
                                    $("#code_error").hide();
                                    $("#captcha_error").hide();
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
                                        $('#code').css("border-color", "#f7b4b4");
                                        $('#captcha').css("border-color", "#f7b4b4");
                                    }

                                },
                                error: function(err) {
                                    if (err.status === 422) {
                                        $("#captcha_error").show();
                                        $("#loading1").click(function() {
                                            $(this).attr('disabled', true)
                                        })
                                    }else{
                                        $("#captcha_error").show();
                                    }
                                }
                            })
                        });
                    });

                </script>
                <div class="col col--full">
                    <button type="submit" class="button button--prime"
                            id="submitcallback1">{{ __('navbar.btnpolys')}}
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




