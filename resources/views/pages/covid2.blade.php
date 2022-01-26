@extends('layouts.general')

@section('content')
    {{--    @dd($wrongAttempts)--}}
    <div class="calculator__section">
        <div class="calculator__block bg-grey">
            <div class="container2" style="display:none;">
                <div style="text-align: center;" id="modal4"></div>
                <div id="openModal" class="modal2">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h3 class="modal-title"></h3>
                            </div>
                            <div class="modal-body">Оплата прошла успешно!<br></br>Чтобы распечатать чек, нажмите на <p>
                                    <a href="kommesk/kz/eogpo_print.html">печать</a></p></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="calculator__block">
                <h2 class="modal-title">Оплатить полис онлайн</h2>
                <p style="display:none;">После нажатия на кнопку «Оплатить» Вы будете направлены на страницу системы
                    EPay банка Халык, где сможете оплатить полис банковской картой. Безопасность операции гарантирует
                    банк. Мы никак не учувствуем в процессе оплаты и не видим и не сохраняем ваши платежные данные
                    (номер карточки и пр.)</p>
                <div class="calculator__block bg-grey details">
                    <div class="article__text">
                        <p style="font-size: larger">
                            <b>Страхование от НС: {{$order->premium_sum}} тенге</b>
                        </p>
                        <p>
                            <b>Страхователь:</b> {{$order->last_name}} {{$order->first_name}} {{$order->patronymic_name}}
                        </p>
                        <p>
                            <b>Период действия:</b> {{$dataUrl['dateBeg'] ?? ''}} - {{$dataUrl['dateEnd'] ?? ''}} </p>
                        <p>
                            <b>Програма:</b>
                            @if(($dataUrl['programISN'] ?? '') == 898641)
                                Програма 1
                            @elseif(($dataUrl['programISN'] ?? '') == 898651)
                                Програма 2
                            @elseif(($dataUrl['programISN'] ?? '') == 898661)
                                Програма 3
                            @endif
                        </p>
                        <p>
                            <b>Страховая сумма:</b>
                            {{$dataUrl['limitSum'] ?? ''}} тенге
                        </p>
                        <p>
                            <b>Способ уведомления:</b>
                            @if(($dataUrl['notificationISN'] ?? '') == 898811)
                                Email от Коммеска + Email от ЕСБД
                            @elseif(($dataUrl['notificationISN'] ?? '') == 898821)
                                Email от Коммеска + SMS от ЕСБД
                            @elseif(($dataUrl['notificationISN'] ?? '') == 898831)
                                SMS от ЕСБД
                            @elseif(($dataUrl['notificationISN'] ?? '') == 898841)
                                SMS от Коммеска + Email от ЕСБД
                            @elseif(($dataUrl['notificationISN'] ?? '') == 898851)
                                SMS от Коммеска + SMS от ЕСБД
                            @endif
                        </p>
                        <p>
                            <b>Email:</b>
                            {{$dataUrl['email'] ?? ''}}
                        </p>
                    </div>
                    <div class="details__total"><span class="text-grey">Сумма к оплате: </span>{{$order->premium_sum}}
                    </div>
                </div>

                <div class="grid">
                    <div class="col col--6-12 teldiv">
                        <label for="phone" class="field-set__label NumpadInputMaster">Для перехода к оплате подтвердите
                            свой номер телефона</label>
                        <input type="tel" class="field interTel" id="phone" name="confirmTel"
                               value="{{$dataUrl['phone'] ?? ''}}" disabled>
                    </div>
                    <div class="col col--6-12 telbuttondiv"><br/>
                        <button class="buttonSmsFirst button button--hollow" style="display: none"><a
                                href="javascript:void(0)" onClick="sendSMS()"
                                class='sendLink'><b>Получить код проверки</b></a>
                        </button>
                        <span class='smswaiting' style='display:none;'>До повторной отправки  СМС осталось
                            <span id='sec'></span> <span id="timeType">сек.</span></span>
                    </div>

                    <div class="col col--6-12 codedivs" style="display:none;">
                        <input type="text" class="field" id="code" value="" placeholder="Введите код" onkeyup="showOrHideBlock('code_error','code')">
                        <strong><small id="code_error" class="form-text text-" style="display: none; color: crimson">
                                Вы не указали код</small></strong>
                    </div>
                    <div class="col col--6-12 codedivs" style="display:none;">
                        <button class="buttonSmsSecond button button--hollow"><a href="javascript:void(0)"
                                                                                 onClick="confirmcode()">Подтвердить</a>
                        </button>
                    </div>

                </div>

                <div id="step3" style="display: none">
                    <h3 class="calculator__title">Номер заказа: {{$order_id}}<br/>К оплате: {{$order->premium_sum}} ₸
                    </h3>
                    <div class="delivery-disq text-grey">
                        <p>
                            После нажатия на кнопку «Оплатить» вы будете направлены на страницу одного из наших
                            партнерских платежных ресурсов, для оплаты страхового полиса. </p>
                        <p>
                            Безопасность операции гарантирует банк. Мы никак не участвуем в процессе оплаты, не видим и
                            не сохраняем ваши платежные данные (номер карточки и пр.) </p>
                        <p style="font-weight:bold; color:red;">
                            Для осуществления оплаты необходимо, чтобы Ваша банковская карта была открыта для
                            интернет-транзакций. По этому вопросу Вы можете обратиться в банк, где была выпущена Ваша
                            карта. </p>
                    </div>

                    <pre></pre>
                    <div class="article__text">
                        <fieldset class="field-set col col--full">
                            <label class="field-set__label"></label>
                            <label class="checkbox">
                                <input type="checkbox" id="agreeWithRule" value="yes">
                                <span class="checkbox__label">С <a href="{{asset('images/files/rules/policy.pdf')}}" style="text-decoration: underline;" target="_blank">Правилами</a> страхования ознакомлен</span>
                            </label>
                        </fieldset>
                        <fieldset class="field-set col col--full">
                            <label class="field-set__label"></label>
                            <label class="checkbox">
                                <input type="checkbox" id="agreeWithPolicy" value="yes">
                                <span class="checkbox__label">Я согласен на обработку <a
                                        href="{{asset('images/files/rules/policy.pdf')}}"
                                        target="_blank"
                                        style="text-decoration: underline;">персональных данных</a> </span>
                            </label>
                        </fieldset>


                        <fieldset class="field-set col col--full">
                            <label class="field-set__label"></label>
                            <label class="checkbox">
                                <input type="checkbox" id="agreeWithData" value="yes">
                                <span class="checkbox__label">Подтверждаю корректность введенных данных</span>
                            </label>
                        </fieldset>
                    </div>

                    <button class="button button--prime" id="paymentButton">Оплатить</button>
                    <form action="https://epay.kkb.kz/jsp/process/logon.jsp" method="post">
                        <input type="hidden" name="Signed_Order_B64"
                               value="PGRvY3VtZW50PjxtZXJjaGFudCBjZXJ0X2lkPSJjMTgzYzZkZiIgbmFtZT0iS29tbWVzay1PbWlyIj48b3JkZXIgb3JkZXJfaWQ9IjQ3MjAwODIiIGFtb3VudD0iMTAyMDYiIGN1cnJlbmN5PSIzOTgiPjxkZXBhcnRtZW50IG1lcmNoYW50X2lkPSI5ODc0NTcwMSIgYW1vdW50PSIxMDIwNiIvPjwvb3JkZXI+PC9tZXJjaGFudD48bWVyY2hhbnRfc2lnbiB0eXBlPSJSU0EiPnBKNDdScFZCMkFWeitqcm5qZW5iYlJPdjFXSldzQ29PR013M2NnRVc1dWJNbEtKUFVJV1pGeWh2dXR5dUMySXVBcUtWUUhBL0tKRGVKZmJhbU9EaWxyR2pKK1dKSzhKejM0bWh2aEU4ckZtTUgwL2tESE9zMDVWUkdiNlhUdTFFV0g0UjdvcWRSajRBcnNDU1ZKVTZwLzZ5MURMdmRQanI0akQ0aVUzUTJKTT08L21lcmNoYW50X3NpZ24+PC9kb2N1bWVudD4=">
                        <input type="hidden" name="Email" value="">
                        <input type="hidden" name="Language" value="rus">
                        <input type="hidden" name="BackLink" value="https://kommesk.kz/eogpo-result.html">
                        <input type="hidden" name="FailureBackLink"
                               value="https://kommesk.kz/eogpo.html?productOrderId=4720082&hash=562441748c789c5edbbfb99647461c3d&step=2&productOrderId=4720082&result=failure#payment">
                        <input type="hidden" name="PostLink" value="https://kommesk.kz/engine/epay-response3.php">
                        <input type="hidden" name="appendix"
                               value="PGRvY3VtZW50PjxpdGVtIG51bWJlcj0iMSIgbmFtZT0i0J7Qv9C70LDRgtCwINC/0L7Qu9C40YHQsCIgcXVhbnRpdHk9IjEiIGFtb3VudD0iMTAyMDYiLz48L2RvY3VtZW50Pg==">

                        <input type="submit" class="button button--prime" id="payButton" style="display: none"
                               data-behavior="analytics" data-analytics-action="pay_kkb" value="Оплатить"/>
                    </form>

                </div>

                <br/>
                <br/>
                <button class="button button--hollow" value="step1" name="prevStep" id="prevStep">Предыдущий шаг
                </button>
            </div>
        </div>
        <div id='aj_result'></div>
    </div>
    <script type="text/javascript" src="https://test-epay.homebank.kz/payform/payment-api.js"></script>
    <script>
        function showError(text) {
            $('#modalText').html(text);
            $('#modalError').modal('show');
        }
        // функция для скрытия ошибок после заполения поля

        function showOrHideBlock(errorBlock, manipulationBlock) {
            $('#' + errorBlock).hide();
        }

        var timerId;
        var timeOut;
        $(document).ready(function () {
            wrongAttempts = @json($wrongAttempts ?? '');
            verified = @json($verified ?? '') === true ? true : false;
            if (verified) {
                $('.codedivs').hide();
                $(".sendLink").hide();
                $(".smswaiting").hide();
                $('#step3').show();
            } else {
                let timeLimit = @json($timeLimitReached);
                if (timeLimit != null) {
                    if (timeLimit.type == 'сек.') {
                        if (timeLimit.number < 60) {
                            clearInterval(timerId);
                            clearTimeout(timeOut);
                            initresendwait(60 - timeLimit.number);
                            if (wrongAttempts > 2) {
                                $('.codedivs').hide();
                            }
                        } else $('.buttonSmsFirst').show()
                    } else {
                        clearInterval(timerId);
                        clearTimeout(timeOut);
                        initresendwait(timeLimit.number, true, 60000);
                        if (timeLimit.showCodedivs == 'true') {
                            $('.codedivs').show();
                        }
                    }
                } else {
                    $('.buttonSmsFirst').show()
                }
            }

        });
        $(document).on("click", "#prevStep", async function () {
            let allowedDate = @json($allowedDate ?? '');
            let clearDate;
            if (allowedDate == 'true') clearDate = 0;
            else clearDate = 1;
            $.ajax({
                type: "POST",
                url: "{{route('covid.prevStep')}}",
                data: {
                    step: 1,
                    clearDate: clearDate,
                    productOrderId: {{$order_id}},
                    hash: "{{$hash}}",
                    _token: '{{csrf_token()}}'
                },

                beforeSend: function () {
                    $('#overLoader').show();
                },

                success: await function (data) {
                    $('#overLoader').hide();
                    if (data.code == 200) {
                        window.location.href = "/covid?productOrderId={{$order_id}}&hash={{$hash}}&step=1";
                    }
                },
                failure: function () {
                    showError("Неизвестная ошибка");
                }
            });

        });

        async function sendSMS() {
            var phone = $('#phone').val().replace(/\D/g, '');
            $.ajax({
                type: 'POST',
                url: '{{route('covid.sendSms')}}',
                data: {
                    order_id: {{$order_id}},
                    hash: '{{$hash}}',
                    phone: phone,
                    _token: '{{csrf_token()}}'
                },

                success: await function (data) {
                    console.log(data)
                    if (data.success == true) {
                        clearInterval(timerId);
                        clearTimeout(timeOut);
                        if (data.time_limit_reached != null && data.time_limit_reached?.type == 'мин.') {
                            initresendwait(data.time_limit_reached.number, true, 60000);
                        } else {
                            initresendwait();
                        }
                        $('.codedivs').show();
                    } else showError('Попробуйте еще раз');
                }
            });
        }

        function initresendwait(seconds, ddos = false, timeStep = 1000) {
            $(".buttonSmsFirst").hide();
            $(".sendLink").html('Отправить смс повторно');
            $(".sendLink").hide();
            if (!ddos) {
                $(".smswaiting, .codedivs").show();
            } else {
                $(".smswaiting").show();
            }
            seconds = seconds == null ? 60 : seconds;
            $("#sec").html(seconds);
            if (timeStep == 60000) {
                $('#timeType').html('мин.')
            } else $('#timeType').html('сек.')
            timerId = setInterval(function () {
                if (parseInt($("#sec").html()) > 0) {
                    $("#sec").html(parseInt($("#sec").html()) - 1);
                }
            }, timeStep);

            timeOut = setTimeout(function () {
                clearInterval(timerId);
                $(".buttonSmsFirst").show();
                $(".sendLink").show();
                $(".smswaiting").hide();
                $('.codedivs').hide();
            }, (seconds) * timeStep);
        }

        async function confirmcode() {
            var phone = $('#phone').val().replace(/\D/g, '');
            $.ajax({
                type: 'POST',
                url: "{{route('covid.confirmCode')}}",
                data: {
                    order_id: {{$order_id}},
                    hash: '{{$hash}}',
                    phone: phone,
                    code: $("#code").val(),
                    _token: '{{csrf_token()}}'
                },
                beforeSend: function () {
                    let a = false;
                    if ($("#code").val() == '') {
                        $("#code_error").show();
                        a = true;
                    }
                    if (a) return false;
                },
                success: await function (data) {
                    if (data.success == true) {
                        $('.codedivs').hide();
                        $(".sendLink").hide();
                        $(".smswaiting").hide();
                        $('#step3').show();
                    } else {
                        if (!data.limit_reached) {
                            showError('Попробуйте еще раз');
                        } else {
                            showError('Вы исчерпали 3 попытки');
                            if (data.time_limit_reached != null) {
                                $('.codedivs').hide();
                                $(".sendLink").hide();
                                clearInterval(timerId);
                                clearTimeout(timeOut);
                                if (data.time_limit_reached?.type == 'мин.') {
                                    // alert('минутный таймер запуск')
                                    initresendwait(data.time_limit_reached.number, true, 60000);
                                } else {
                                    initresendwait(60 - data.time_limit_reached?.number)
                                    $('.codedivs').hide();
                                    $(".sendLink").hide();
                                }
                            } else {
                                $(".buttonSmsFirst").show();
                                $(".sendLink").show();
                                // $(".smswaiting").hide();
                                $('.codedivs').hide();
                            }
                        }
                    }
                }
            });
        }

        $(document).on("click", "#paymentButton", function() {

            var check = '';
            let allowedDate = @json($allowedDate ?? '');
            if(!$("#agreeWithRule").is(":checked")) {
                check += '-Пожалуйста, ознакомьтесь с Правилами страхования<br/>';
            }
            if(!$("#agreeWithPolicy").is(":checked")) {
                check += '-Пожалуйста, подтвердите согласие на обработку персональных данных<br/>';
            }
            if(!$("#agreeWithData").is(":checked")) {
                check += '-Пожалуйста, подтвердите корректность введенных данных<br/>';
            }
            if(allowedDate != 'true')
            {
                check += 'Дата начала действия договора должна быть минимум на 7 дней больше текущей. Пожалуйста перейдите на предыдущий шаг';
            }
            if(check.length > 0) {
                showError(check);
                return;
            }
            alert(111);
            $.ajax({
                type: "POST",
                url: "{{route('epay.payment-auth')}}",
                dataType: "json",
                data: {
                    order_id: {{$order_id}},
                    _token: '{{csrf_token()}}',
                    hash: '{{$hash}}'
                },
                success: function(data) {
                    var auth = data;
                    var invoiceId = {{$order_id}};
                    var amount = {{$order->premium_sum}};
                    var hostname = window.location.hostname;

                    var createPaymentObject = function(auth, invoiceId, amount) {
                        var paymentObject = {
                            invoiceId: invoiceId,
                            backLink: "https://" + hostname + "/covid/success-payment/?productOrderId=" + invoiceId +"&hash=" + '{{$hash}}',
                            failureBackLink: "https://" + hostname + "/covid/failure-payment?productOrderId=" + invoiceId +"&hash=" + '{{$hash}}',
                            postLink: "https://" + hostname + "/api/epay/response",
                            failurePostLink: "https://" + hostname + "/api/epay/response",
                            language: "RU",
                            description: "Оплата в интернет магазине",
                            accountId: "testuser1",
                            terminal: "67e34d63-102f-4bd1-898e-370781d0074d",
                            amount: amount,
                            currency: "KZT",
                            phone: "{{$dataUrl['phone'] ?? ''}}",
                            email: "{{$dataUrl['email'] ?? ''}}",
                            cardSave: true
                        };
                        paymentObject.auth = auth;
                        return paymentObject;
                    };

                    halyk.pay(createPaymentObject(auth, invoiceId, amount));
                }
            });
        });


    </script>
    <!-- Button trigger modal -->

    <div class="modal fade" id="modalError" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                </div>
                <div class="modal-body">
                    <p id="modalText" style="color: red;"></p>
                </div>
                <div class="modal-footer">
                </div>
            </div>
        </div>
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
    {{--------------------------}}
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
