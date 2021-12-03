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
                <label class="field-set__label">Эл. почта</label>
                <input type="email" class="field" name="email1" id="email1" onkeyup="showOrHideBlock('email_error1','email1')">

                <strong> <small id="email_error1" class="form-text text-"
                                style=" display: none; color: crimson">Неправильный формат почты</small></strong>
            </fieldset>


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
                function validateEmail(email) {
                    const re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
                    return re.test(email);
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
                                frompage: frompage,
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

                                $("#email1").on("input", validate);
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
                                    $(".callb1").html('<h3 style="color:springgreen">Ваше сообщение отправлено!</h3>');
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
