<section class="feedback callb1" id="callb1">
    <h3 class="feedback__title">{{ __('navbar.bc3_1')}}</h3>
    <form action="#" method="" id="call-popup">
        <div class="grid">
            <input type="hidden" id="frompage" class="field" name="frompage" value="{{$frompage}}">
            <fieldset class="field-set col col--full" style="">
                <label class="field-set__label">{{ __('navbar.bc4')}}</label>
                <input type="text" class="field" onkeyup="showOrHideBlock('fullname_error1','fullname1')" id="fullname1"
                       name="fullname">

                <strong><small id="fullname_error1" class="form-text text-" style="display: none;  color: crimson">Вы не
                        указали как вас зовут</small></strong>
            </fieldset>

            <fieldset class="field-set col col--1-2" style="">
                <label class="field-set__label">{{ __('navbar.bc5')}}</label>
                <input type="tel" class="field tel-masked" id="phone-input1"
                       onkeyup="showOrHideBlock('phone_error1','phone-input1')" name="phone" placeholder="">
                <strong> <small id="phone_error1" class="form-text text-" style="display: none; color: crimson">Вы не
                        указали телефон</small></strong>
            </fieldset>


            <fieldset class="field-set col col--1-2" style="false">
                <label class="field-set__label">
                    Эл. почта
                </label>
                <input type="email" class="field" name="email" id="email1"
                       onclick="$(this).css('border-color','#ccc')"/>
            </fieldset>

            <fieldset class="field-set col col--1-2">
                <label class="field-set__label">Удобное время (время Астаны)</label>
                <input type="text" class="field field--date" value="" id="call-popup-call-date1" name="call_date1"
                       data-timepicker="true" data-time-format="hh:ii" data-callback-time="" readonly/>
            </fieldset>

            <div class="field-set col col--1-2">
                <br>
                <label class="checkbox">
                    <input type="checkbox" name="call_now1" id="call-popup-call-now1" class="new-styler"
                           onclick="disableDate(this)"/>
                    <span class="checkbox__label">Позвоните прямо сейчас</span>
                </label>
            </div>
            <fieldset class="field-set col col--full" style="false">
                <textarea class="field" name="qst" value="" id="qst" placeholder="Ваш вопрос" rows="5"></textarea>
            </fieldset>

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

                .nav-section {
                    display: none;
                }

                .removejust {
                    display: none;
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
            </style>


            <script>


                function showOrHideBlock(errorBlock, manipulationBlock) {
                    $('#' + errorBlock).hide();
                }

                var checkNow;

                function disableDate(checkBox) {
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
                        let month, day, minutes;
                        if ((today1.getMonth() + 1) < 10) {
                            month = '0' + today1.getMonth() + 1;
                        } else month = today1.getMonth() + 1;
                        if ((today1.getDate()) < 10) {
                            day = '0' + today1.getDate();
                        } else day = today1.getMonth() + 1;
                        if (today1.getMinutes() < 10) {
                            minutes = '0' + today1.getMinutes();
                        } else minutes = today1.getMinutes();
                        var now = today1.getFullYear() + '-' + month + '-' + day + ' ' + today1.getHours() + ':' + minutes;

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
                        var frompage = $('#frompage').val();
                        var callDate = $('#call-popup-call-date1').val();
                        var callNow;
                        if (checkNow) {
                            callNow = true;
                        } else callNow = false;
                        var qst = $('#qst').val();

                        $.ajax({
                            url: "/sendhtmlmail",
                            type: 'get',
                            data: {
                                fullname: fullname,
                                phone: phone,
                                email: email,
                                qst: qst,
                                frompage: frompage,
                                callDate: callDate,
                                callNow: callNow,

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
                .nav-section {
                    display: none;
                }
                .removejust {
                    display: none;
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
            </style>
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

