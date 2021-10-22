@extends('layouts.general')

@section('content')

    <main class="main">
        <div class="container">
            <div class="contacts">
                <section class="feedback callb1" id="callb1">
                    <h3 class="feedback__title"><b>{{ __('navbar.provpol')}}</b></h3>
                    <div id='polisrez_'>&nbsp;</div>
                    <form action="#" method="" id="call-popup">
                        <div class="grid">
                            <fieldset class="field-set col col--full">
                                <label class="field-set__label">{{ __('navbar.policycod')}}</label>
                                <input type="text" class="field" onkeyup="showOrHideBlock('code_error','code')" id="code" name="code">
                                <strong>
                                    <small id="code_error" class="form-text text-" style="display: none;  color: crimson">Поле должно быть заполнено!</small>
                                </strong>
                            </fieldset>

                            <fieldset class="field-set col col--full" style="">
                                <label class="field-set__label">{{ __('navbar.captch')}}</label>
                                <div class="captcha">
                                    <span>{!! captcha_img() !!}</span>

                                    <button type="button" class="btn btn-" class="reload" id="reload"
                                            style="margin-bottom: 24px; color: #00abcd; font-size:25px">
                                        &#x21bb;
                                    </button>
                                </div>
                                <input type="text" class="field" placeholder="" onkeyup="showOrHideBlock('captcha_error','captcha')" id="captcha"
                                       name="captcha">

                                <strong>
                                    <small id="captcha_error" class="form-text text-" style="display: none;  color: crimson">Не пройдена капча</small>
                                </strong>

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

                            <script>
                                function showOrHideBlock(errorBlock, manipulationBlock) {
                                    $('#' + errorBlock).hide();
                                }

                                //начало скрипта для обратного звонка
                                $(document).ready(function () {
                                    $loading = $("#loading1");

                                    $('input[name="code"]').keyup(function () {
                                        if ($(this).val().length > 1) {
                                            $(this).closest('fieldset').addClass('has-success');
                                            $(this).closest('fieldset').removeClass('has-error');
                                            $("#policyExpired").hide();
                                            $("#policyError").hide();
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
                                    $('#submitcallback1').click(async function (event) {
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
                                                console.log('сообщение ушло')
                                                $loading.hide();
                                                $('#submitcallback1').show();

                                            },
                                            success: await function (data) {
                                                if (data == 'true') {
                                                     $.ajax({
                                                        url: "https://connect.cic.kz/centras/ckl/checkPolicy",
                                                        type: 'post',
                                                        data: {
                                                            code: code,
                                                            company: 'ckl',
                                                            token: "wesvk345sQWedva55sfsd*g"
                                                        },
                                                        success: function (data) {
                                                            if(data.status == 'expired' && data.code == 200){
                                                                $("#policyExpired").html('<p class="error">Срок действия полиса с номером ' + data.id + '  истек.</p>');
                                                                $("#policyExpired").show();
                                                                $("#reload").click();
                                                                // $("#captcha").val(''); // стирает капчу который неактуальный
                                                            }
                                                            else if(data.status == 'success' && data.code == 200){
                                                                $(".callb1").html('<h3>Номер договора : ' + data.id + '</h3><br><h3>Статус договора : ' + data.st + '</h3><br><h3>Даты действия : ' + data.period + '</h3>');
                                                                $("#reload").click();
                                                            }
                                                            if(data.code == 404){
                                                                $("#reload").click();
                                                                // $("#captcha").val('');
                                                                $("#policyError").show();
                                                            }
                                                        },
                                                    })
                                                    dataLayer.push({'event': 'callback_sent'});
                                                    $('#feedbackModal1').css('max-height', '155px');
                                                } else {
                                                    $("#cberror").html(data);
                                                    $("#cberror").fadeIn(1500);
                                                    $('#code').css("border-color", "#f7b4b4");
                                                    $('#captcha').css("border-color", "#f7b4b4");
                                                }

                                            },
                                            error: function (err) {
                                                if (err.status === 422) {
                                                    $("#captcha_error").show();
                                                    $("#loading1").click(function () {
                                                        $(this).attr('disabled', true)
                                                    })
                                                    $("#reload").click()
                                                } else {
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
                            <div id="policyError" style="display: none" >
                                <p class="error">Договор страхования не найден. Пожалуйста, проверьте правильность ввода номера договора!</p>
                            </div>
                            <div id="policyExpired" style="display: none" >
                            </div>
                        </div>
                    </form>

                </section>
                </section>

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




