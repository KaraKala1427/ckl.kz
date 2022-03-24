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
                            {{__('navbar.payment_successfully')}}
                        </div>
                    </div>
                </div>
            </div>
            <div class="calculator__block">
                <h2 class="modal-title">{{__('navbar.pay_the_policy_online')}}</h2>
                <p style="display:none;">{{__('navbar.covid_halyk_text')}}</p>
                <div class="calculator__block bg-grey details">
                    <div class="article__text">
                        <p style="font-size: larger">
                            <b>{{__('navbar.covid_title_2')}}<span class="premium">@if(($order->premium_sum ?? '') > 0) {{ number_format($order->premium_sum ?? '', 0, ',', ' ')}} @endif</span>{{__('navbar.currency')}}</b>
                        </p>
                        <p>
                            <b>{{__('navbar.covid_insurant')}}</b> {{$order->last_name}} {{$order->first_name}} {{$order->patronymic_name}}
                        </p>
                        <p>
                            <b>{{__('navbar.covid_validity')}}</b> {{$dataUrl['dateBeg'] ?? ''}} - {{$dataUrl['dateEnd'] ?? ''}} </p>
                        <p>
                            <b>{{__('navbar.program_isn')}}:</b>
                            @if(($dataUrl['programISN'] ?? '') == 898641)
                                {{__('navbar.programs_one')}}
                            @elseif(($dataUrl['programISN'] ?? '') == 898651)
                                {{__('navbar.programs_two')}}
                            @elseif(($dataUrl['programISN'] ?? '') == 898661)
                                {{__('navbar.programs_three')}}
                            @endif
                        </p>
                        <p>
                            <b>{{__('navbar.limitSum')}}:</b>
                            {{$dataUrl['limitSum'] ?? ''}} {{__('navbar.currency')}}
                        </p>
                        <p>
                            <b>{{__('navbar.notification_isn')}}:</b>
                            @if(($dataUrl['notificationISN'] ?? '') == 898811)
                                 {{__('navbar.notification_isn_898811')}}
                            @elseif(($dataUrl['notificationISN'] ?? '') == 898821)
                                {{__('navbar.notification_isn_898821')}}
                            @elseif(($dataUrl['notificationISN'] ?? '') == 898831)
                                {{__('navbar.notification_isn_898831')}}
                            @elseif(($dataUrl['notificationISN'] ?? '') == 898841)
                                {{__('navbar.notification_isn_898841')}}
                            @elseif(($dataUrl['notificationISN'] ?? '') == 898851)
                                {{__('navbar.notification_isn_898851')}}
                            @endif
                        </p>
                        <p>
                            <b>{{__('navbar.email')}}:</b>
                            {{$dataUrl['email'] ?? ''}}
                        </p>
                        @if($dataUrl['agentISN'] != null)
                            <p>
                                <b>{{__('navbar.phone')}}:</b>
                                {{$dataUrl['phone'] ?? ''}}
                            </p>
                        @endif
                    </div>
                    <div class="details__total"><span class="text-grey">{{__('navbar.covid_amount_payable')}}</span><span class="premium">
                            @if(($order->premium_sum ?? '') > 0) {{ number_format($order->premium_sum ?? '', 0, ',', ' ')}} @endif</span>
                        тг
                    </div>
                    @if($dataUrl['agentISN'] == null)
                    <div class="grid">
                        <div class="col col--6-12 teldiv">
                            <label for="phone" class="field-set__label NumpadInputMaster">
                                {{__('navbar.covid_number_confirmation')}}</label>
                            <input type="tel" class="field interTel" id="phone" name="confirmTel"
                                   value="{{$dataUrl['phone'] ?? ''}}" disabled>
                        </div>
                        <div class="col col--6-12 telbuttondiv"><br/>
                            <button class="buttonSmsFirst button button--hollow" style="display: none"><a
                                    href="javascript:void(0)" onClick="sendSMS()"
                                    class='sendLink'><b>{{__('navbar.get_code_confirmation')}}</b></a>
                            </button>
                            <span class='smswaiting' style='display:none;'>{{__('navbar.resending_sms')}}
                            <span id='sec'></span> <span id="timeType">{{__('navbar.covid_seconds')}}</span></span>
                        </div>

                        <div class="col col--6-12 codedivs" style="display:none;">
                            <input type="text" class="field" id="code" value="" placeholder="Введите код" onkeyup="showOrHideBlock('code_error','code')">
                            <strong><small id="code_error" class="form-text text-" style="display: none; color: crimson">
                                    {{__('navbar.covid_code_error')}}</small></strong>
                        </div>
                        <div class="col col--6-12 codedivs" style="display:none;">
                            <button class="buttonSmsSecond button button--hollow"><a href="javascript:void(0)"
                                                                                     onClick="confirmcode()">{{__('navbar.confirm')}}</a>
                            </button>
                        </div>
                    </div>
                    @endif
                <div id="step3" style="display: none">
                    <h3 class="calculator__title premium">{{__('navbar.covid_order_number')}} {{$order_id}}<br/>{{__('navbar.covid_to_pay')}}<span class="premium">
                             @if(($order->premium_sum ?? '') > 0) {{ number_format($order->premium_sum ?? '', 0, ',', ' ')}} @endif</span> ₸
                    </h3>
                    <div class="delivery-disq text-grey">
                        <p>
                            {{__('navbar.covid_description_halyk1')}}
                        </p>
                        <p>
                            {{__('navbar.covid_description_halyk2')}}
                        </p>
                        <p style="font-weight:bold; color:red;">
                            {{__('navbar.covid_description_halyk3')}} </p>
                    </div>

                    <pre></pre>
                    <div class="article__text">
                        <fieldset class="field-set col col--full">
                            <label class="field-set__label"></label>
                            <label class="checkbox">
                                <input type="checkbox" id="agreeWithRule" value="yes">
                                <span class="checkbox__label">С  <a href="@if(($dataUrl['programISN'] ?? '') == 898641)

                                    {{ route('program-covid',[ 'id' =>'1'])}}
                                    @elseif(($dataUrl['programISN'] ?? '') == 898651)

                                    {{ route('program-covid',[ 'id' =>'2'])}}

                                    @elseif(($dataUrl['programISN'] ?? '') == 898661)

                                    {{ route('program-covid',[ 'id' =>'3'])}}

                                    @endif" style="text-decoration: underline;" target="_blank">
                                           {!! __('navbar.terms_and_conditions_covid2') !!}
                            </label>
                        </fieldset>
                        <fieldset class="field-set col col--full">
                            <label class="field-set__label"></label>
                            <label class="checkbox">
                                <input type="checkbox" id="agreeWithPolicy" value="yes">
                                <span class="checkbox__label">
                                    {!! __('navbar.i_agree_personal_data_ch') !!}
                            </label>
                        </fieldset>
                        <fieldset class="field-set col col--full">
                            <label class="field-set__label"></label>
                            <label class="checkbox">
                                <input type="checkbox" id="agreeWithData" value="yes">
                                <span class="checkbox__label">{!! __('navbar.agree_correctly_data_ch') !!}</span>
                            </label>
                        </fieldset>
                        @if(($dataUrl['agentISN']) != null)
                        <fieldset class="field-set col col--full">
                            <label class="field-set__label"></label>
                            <label class="checkbox">
                                <input type="checkbox" id="agreeWithEmail" value="yes">
                                <span class="checkbox__label">{{__('navbar.agree_email_process_ch')}} {{$dataUrl['agentEmail'] ?? ''}}</span>
                            </label>
                        </fieldset>
                        @endif
                    </div>
                    @if(($dataUrl['agentISN']) != null)
                    <fieldset class="field-set col col--full">
                        <label class="field-set__label"></label>
                        <label class="checkbox">
                            <input type="checkbox" id="agreeWithFailureDiseases" value="yes">
                            <span class="checkbox__label">{!! __('navbar.agree_with_no_diseases_ch') !!}
                        </label>
                    </fieldset>
                    @endif

                    @if(($dataUrl['agentISN']) != null)
                    <fieldset class="field-set col col--full">
                        <label class="field-set__label"></label>
                        <label class="checkbox">
                            <input type="checkbox" id="agreeWithBeneficiary" value="yes">
                            <span class="checkbox__label">{!! __('navbar.agree_with_beneficiary_ch') !!}
                            </span>
                        </label>
                    </fieldset>
                    @endif
                    <button class="button button--prime" id="paymentButton">{{__('navbar.payment_button_covid')}}</button>
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
                    @if(($dataUrl['agentISN']) != null)

                    @else
                        <button class="button button--hollow" value="step1" name="prevStep" id="prevStep">
                            <a href="/covid?productOrderId={{$order_id}}&hash={{$hash}}&step=1">{{__('navbar.covid_prev_step')}}</a>
                        </button>
                    @endif
            </div>
        </div>
        <div id='aj_result'></div>
    </div>
    <script type="text/javascript" src="https://epay.homebank.kz/payform/payment-api.js"></script>
    <script>

//        $('.premium').text((i, text) => {
//            const [premium] = text.split(' ');
//            return `${(+premium).toLocaleString('ru-RU')}`;
//        });

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
            let wrongAttempts = @json($wrongAttempts ?? '');
            let verified = @json($verified ?? '') === true ? true : false;
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
                    } else showError('{{__('navbar.covid_try_again')}}');
                }
            });
        }

        function initresendwait(seconds, ddos = false, timeStep = 1000) {
            $(".buttonSmsFirst").hide();
            $(".sendLink").html('{{__('navbar.covid_send_sms_again')}}');
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
                            showError('{{__('navbar.covid_try_again')}}');
                        } else {
                            showError('{{__('navbar.exhausted_the_limit')}}');
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
            let agentEmail = @json($dataUrl['agentEmail'] ?? '');
            var check = '';
            let allowedDate = @json($allowedDate ?? '');

            if(!$("#agreeWithRule").is(":checked")) {
                check += '{{__('navbar.agree_with_rule')}} <br/> ';
            }
            if(!$("#agreeWithPolicy").is(":checked")) {
                check += '{{__('navbar.agree_with_policy')}}<br/>';
            }
            if(!$("#agreeWithData").is(":checked")) {
                check += '{{__('navbar.agree_with_data')}}<br/>';
            }

            if(agentEmail != ''){
                if(!$("#agreeWithBeneficiary").is(":checked")) {
                    check += '{{__('navbar.agree_with_beneficiary')}}<br/>';
                }
                if(!$("#agreeWithEmail").is(":checked")) {
                    check += '{{__('navbar.agree_with_email')}} ' + agentEmail + '<br/>';
                }

                if (!$("#agreeWithFailureDiseases").is(":checked") && $("#agreeWithRule").is(":checked") && $("#agreeWithBeneficiary").is(":checked")
                    && $("#agreeWithData").is(":checked") && $("#agreeWithPolicy").is(":checked")) {
                    check += '{!! __('navbar.agree_with_failure_diseases_all') !!}<br/>';

                } else if (!$("#agreeWithFailureDiseases").is(":checked")) {
                    check += '{{__('navbar.agree_with_failure_diseases')}}<br/>';
                }
            }

            if(allowedDate != 'true')
            {
                check += '{{__('navbar.allowed_date')}}';
            }
            if(check.length > 0) {
                showError(check);
                return;
            }
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
                            accountId: "98811611",
                            terminal: "6eddddad-df65-4aea-b7b1-d323340dce27",
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

        @include('mini_parts.covid2_modal')

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
