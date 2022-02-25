<script src="https://unpkg.com/imask"></script>
<script type="text/javascript">


    function wrongCheckBoxModal(text) {

        $('#modalTextCheckBox').html(text);
        $('#modalCheckBox').modal('show');

    }

    // возврат success в формате json через модальное окно

    function showSuccess(text) {
        $('#modalTextSuccess').html(text);
        $('#modalSuccess').modal('show');
    }


    // возврат оишбок в формате json через модальное окно

    function showError(text) {
        $('#modalText').html(text);
        $('#modalError').modal('show');
    }

    // функция для скрытия ошибок после заполения поля

    function showOrHideBlock(errorBlock, manipulationBlock) {
        $('#' + errorBlock).hide();
    }




    $(document).ready(function () {

        $('.input-check').on("change keypress", function () {

            $("#nextStepShow").hide();
            $("#sendLinkShow").hide();

            $("#sendOrder").prop("disabled", false);
            $("#sendLink").prop("disabled", false);

        });

        if ($('.email-field').css('display') == 'none'){

            $("#phone-field").attr('class', 'col col-12');

        }

        const queryString = window.location.search;
        const urlParams = new URLSearchParams(queryString);
        const orderId = urlParams.get('productOrderId')
        const hash = urlParams.get('hash')
        $('#order_id').val(orderId);
        $('#hash').val(hash);

        $('.edate').datepicker({
            dateFormat: "dd.mm.yyyy"
        });


        $("#programISN").on('change', function () {

            if ($("#programISN").val() == 898641) {

                $("#programLink").hide();
                $("#programLink2").hide();
                $("#programLink3").hide();
                $("#program2").hide();
                $("#program3").hide();
                $("#program1").show();
                $("#programLink1").show();

            } else if ($("#programISN").val() == 898651) {

                $("#program1").hide();
                $("#program3").hide();
                $("#programLink").hide();
                $("#programLink1").hide();
                $("#programLink3").hide();
                $("#program2").show();
                $("#programLink2").show();

            } else if ($("#programISN").val() == 898661) {

                $("#programLink").hide();
                $("#programLink1").hide();
                $("#programLink2").hide();
                $("#program1").hide();
                $("#program2").hide();
                $("#programLink3").show();
                $("#program3").show();

            }else if($("#programISN").val() == 0){

                $("#program1").hide();
                $("#program2").hide();
                $("#program3").hide();
                $("#programLink1").hide();
                $("#programLink2").hide();
                $("#programLink3").hide();
                $("#programLink").show();
            }
        });

        // Валидация почты

        function isEmail(email) {
            if ((email) == '') {
                $("#email_error").html('{{__('navbar.email_error')}}').show();
                return false;
            }
            var regex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
            if (!regex.test(email)) {
                $("#email_error").html('{{__('navbar.incorrectly_email')}}').show();
                return false;
            } else {
                return true;
            }
        }

        // Валидация номера

        function isPhone(phone) {
            if ((phone) == '') {
                $("#phone_error").html('{{__('navbar.phone_error')}}').show();
                return false;
            }
            if (phone.length < 11) {
                $("#phone_error").html('{{__('navbar.incorrectly_number')}}').show();
                return false;
            } else {
                return true;
            }
        }


        $(document).on("click", ".wrongCheckBox", function () {

            var checkBoxLabelId = $(this).attr('id')
            var textModal = '';

            if (checkBoxLabelId === 'insuredInsurerChBox') {
                textModal = '{{__('navbar.insured_insurer_ch_box')}}';
            }

            if (checkBoxLabelId === 'notResidentUsaChBox') {
                textModal = '{{__('navbar.not_resident_usa_ch_box')}}';
            }

            wrongCheckBoxModal(textModal);

        });

        // Маска для поля phone

        $(document).on("keyup change", "[id^=phone]", function () {
            if ($(this).val().substr(1, 1) == 7 || $(this).val().substr(1, 1) == 3) {
                $(this).inputmask('+9 999 999-99-99');
            } else if ($(this).val().substr(1, 1) == 9) {
                $(this).inputmask('+999 99-9999999');
            }

        });

        $(function () {
            $('.phone_number').inputmask('+9 999 999-99-99');
        });


        // Click на отправку форму и рассчет

        $('#sendOrder').on('click', async function(event){
            event.preventDefault();

            // Определение полей checkboxes
            var checkboxes = '';
            $(".checkbox-cov").each(function () {
                if ($(this).is(':checked')) {
                    checkboxes = checkboxes + $(this).attr('id') + "=yes&";
                } else {
                    checkboxes = checkboxes + $(this).attr('id') + "=no&";
                }

            });


            // nextStep click

            $(document).on("click", "#nextStep", async function () {
                $.ajax({
                    type: "POST",
                    url: "{{route('covid.nextStep')}}",
                    data: {
                        step: 2,
                        productOrderId: $("#order_id").val(),
                        hash: $("#hash").val(),
                        _token: '{{csrf_token()}}'
                    },

                    beforeSend: function () {
                        $('#overLoader').show();
                    },

                    success: await function (data) {
                        $('#overLoader').hide();
                        if (data.code == 200) {
                            window.location.href = "/covid?productOrderId=" + $("#order_id").val() + "&hash=" + $("#hash").val() + "&step=2";
                        }
                    },
                    failure: function () {
                        showError('{{__('navbar.covid_unknown_error')}}');
                    }
                });
            });

            $(document).on("click", "#sendLink", async function () {
                var hostname = window.location.hostname;

                const url = "https://" + hostname + "/covid?productOrderId=" + $("#order_id").val() + "&hash=" + $("#hash").val() + "&step=2";
                $.ajax({
                    type: "POST",
                    url: "{{route('covid.sendSmsLinkToPhone')}}",
                    data: {
                        step: 2,
                        productOrderId: $("#order_id").val(),
                        hash: $("#hash").val(),
                        _token: '{{csrf_token()}}',
                        phone: $("#phone").val(),
                        url: url
                    },

                    beforeSend: function () {
                        $('#overLoader').show();
                    },

                    success: await function (data) {
                        $('#overLoader').hide();
                        if (data.code == 200) {
                            showSuccess('{{__('navbar.covid_sms_success')}}');
                            $("#sendLink").prop("disabled", true);
                        }
                    },
                    failure: function () {
                        showError('{{__('navbar.covid_sms_error')}}');
                        $("#sendLink").prop("disabled", false);
                    }
                });
            });

            /////// определяем переменные для проверки полей на пустоту

            var iin = $("#iin").val();
            var firstName = $("#firstName").val();
            var phone = $('#phone').val().replace(/\D/g, '');
            var email = $("#email").val();
            var dateBeg = $("#dateBeg").val();
            var born = $("#born").val();
            var documentGivedDate = $("#documentGivedDate").val();
            var documentNumber = $("#documentNumber").val();
            var documentGivedBy = $("#documentGivedBy").val();

            ///

            if (window.setClient) {
                return false;
            }
            // Сохраням данные в БД
            $.ajax({
                type: 'POST',
                url: "{{route('covid.setOrder')}}",
                dataType: "json",
                data: {
                    action: "checkData",
                    iin: $("#iin").val(),
                    checkboxes: checkboxes,
                    order_id: $("#order_id").val(),
                    hash: $("#hash").val(),
                    firstName: $("#firstName").val(),
                    lastName: $("#lastName").val(),
                    patronymicName: $("#patronymicName").val(),
                    phone: phone,
                    email: $("#email").val(),
                    programISN: $("#programISN").val(),
                    notificationISN: $("#notificationISN").val(),
                    limitSum: $("#limitSum").val(),
                    dateBeg: $("#dateBeg").val(),
                    dateEnd: $("#dateEnd").val(),
                    born: $("#born").val(),
                    documentGivedDate: $("#documentGivedDate").val(),
                    documentNumber: $("#documentNumber").val(),
                    documentGivedBy: $("#documentGivedBy").val(),
                    documentTypeId: $("#documentTypeId").val(),
                    _token: '{{csrf_token()}}'
                },

                // Проверка на пустоту полей

                beforeSend: function () {
                    let a = false;
                    let scrollToElement = false; //До какого элемента скроллить, если false - скролла не будет

                    if (iin == '') {
                        const iinErrorId = "#iin";
                        $("#iin_error").show();
                        scrollToElement = scrollToElement === false ? iinErrorId : scrollToElement;
                        a = true;
                    }
                    if (firstName == '') {
                        const firstNameErrorId = "#firstName";
                        $("#firstName_error").show();
                        scrollToElement = scrollToElement === false ? firstNameErrorId : scrollToElement;
                        //Если в scrollElement записано false,записываем значение emailError,
                        // иначе записываем scrollElement (осталяем значение без изменения)
                        a = true;
                    }

                    if (born == '') {
                        const bornErrorId = "#born";
                        $("#born_error").show();
                        scrollToElement = scrollToElement === false ? bornErrorId : scrollToElement;
                        a = true;
                    }


                    if ($("#documentTypeId").val() < 1) {
                        const documentTypeIdErrorId = "#documentTypeId";
                        $("#documentTypeId_error").show();
                        scrollToElement = scrollToElement === false ? documentTypeIdErrorId : scrollToElement;
                        a = true;
                    }

                    if (documentNumber == '') {
                        const documentNumberErrorId = "#documentNumber";
                        $("#documentNumber_error").show();
                        scrollToElement = scrollToElement === false ? documentNumberErrorId : scrollToElement;
                        a = true;
                    }

                    if (documentGivedDate == '') {
                        const documentGivedDateErrorId = "#documentGivedDate";
                        $("#documentGivedDate_error").show();
                        scrollToElement = scrollToElement === false ? documentGivedDateErrorId : scrollToElement;
                        a = true;
                    }

                    if (documentGivedBy == '') {
                        const documentGivedByErrorId = "#documentGivedBy";
                        $("#documentGivedBy_error").show();
                        scrollToElement = scrollToElement === false ? documentGivedByErrorId : scrollToElement;
                        a = true;
                    }

                    // if ($("#programISN").val() < 1) {
                    //     const programIsnErrorId = "#programISN";
                    //     $("#programISN_error").show();
                    //     scrollToElement = scrollToElement === false ? programIsnErrorId : scrollToElement;
                    //     a = true;
                    // }

                    if (dateBeg == '' || !validateData()) {
                        const dateBegErrorId = "#dateBeg";
                        $("#dateBeg_error").show();
                        scrollToElement = scrollToElement === false ? dateBegErrorId : scrollToElement;
                        a = true;
                    }
                    //
                    // if ($("#notificationISN").val() < 1) {
                    //     const notificationIsnErrorId = "#notificationISN";
                    //     $("#notificationISN_error").show();
                    //     scrollToElement = scrollToElement === false ? notificationIsnErrorId : scrollToElement;
                    //     a = true;
                    // }

                    if (isPhone(phone) == false) {
                        const phoneErrorId = "#phone";
                        $("#phone_error").show();
                        scrollToElement = scrollToElement === false ? phoneErrorId : scrollToElement;
                        a = true;
                    }

                    if (isEmail(email) == false && $("#notificationISN").val() != 898831 &&
                        $("#notificationISN").val() != 898851) {
                        const emailErrorId = "#email";
                        $("#email_error").show();
                        scrollToElement = scrollToElement === false ? emailErrorId : scrollToElement;
                        a = true;
                    }

                    if (scrollToElement) {  // Если в scrollToElement записан какой-то элемент (значение scrollToElement не равно false)
                        $([document.documentElement, document.body]).animate({
                            scrollTop: $(scrollToElement).offset().top
                        }, {
                            duration: 550,
                            easing: "linear"
                        });
                        console.log(a);
                        if (a) return false; // Если a = true - вернется false, если а = false - вернется true
                    }
                    window.setClient = true;
                    $('#overLoader').show();
                },
                success: await function (data) {
                    window.setClient = false;
                    $('#overLoader').hide()
                    if (data.code == 200) {
                        $("#order_id").val(data.order_id);
                        $("#hash").val(data.hash);
                        $("#premium").html(data.premium);
                        $('#premiumWrapper').show();
                        $('#premium').text((i, text) => {
                            const [premium] = text.split(' ');
                            return `${(+premium).toLocaleString('ru-RU')}`;
                        });
                        history.pushState({}, '', "?productOrderId=" + data.order_id + "&hash=" + data.hash + "&step=1");
                        $("#sendOrder").prop('disabled', true)
                        $("#nextStepShow").show();
                        $("#sendLinkShow").show();

                    } else {
                        showError(data.error);
                        $('#overLoader').hide();
                    }
                },
            });
        });


        // Разделение даты через точку

        var input = document.querySelectorAll('.edate');
        var dateInputMask = function dateInputMask(elm) {
            elm.addEventListener('keypress', function (e) {
                if (e.keyCode < 47 || e.keyCode > 57) {
                    e.preventDefault();
                }

                var len = elm.value.length;

                if (len !== 1 || len !== 3) {
                    if (e.keyCode == 47) {
                        e.preventDefault();
                    }
                }
                if (len === 2) {
                    elm.value += '.';
                }
                if (len === 5) {
                    elm.value += '.';
                }
            });
        };
        for (var j = 0; j < 3; j++) {
            dateInputMask(input[j]);
        }

    });

    // Валидация поля ИИН

    document.oninput = function () {
        var input = document.querySelector('.iin');
        input.value = input.value.replace(/\D/g, '');
    }


    // После заполнения поля ИИН тянем данные с Kias
    $(".iin").on('keyup', async function (event) {
        var iin = $("#iin").val();
        $(".form-text").hide();
        if (window.getClient) {
            return false;
        }
        if (iin.length == 12 && event.keyCode !== 13) {
            $.ajax({
                type: 'POST',
                url: "{{route('covid.getClient')}}",
                dataType: "json",
                data: {
                    iin: iin,
                    _token: '{{csrf_token()}}'
                },
                beforeSend: function () {
                    $('.clearFields').val('');
                    window.getClient = true;
                    $('#overLoader').show();
                },
                success: await function (data) {
                    window.getClient = false;
                    $('#overLoader').hide()
                    if (data.code == 200) {
                        if(Array.isArray(data.client)){
                            var filteredData = data.client.filter(function (i){
                                return i.verify_bool == "1"
                            });
                            if (filteredData.length > 0)
                                data = filteredData[0];
                            else data = data.client[0];
                        }
                        else data = data.client;

                        $("#lastName").val(data.Last_Name);
                        $("#firstName").val(data.First_Name);
                        $("#patronymicName").val(data.Middle_Name);
                        $("#born").val(data.Born);
                        $("#documentGivedDate").val(data.DOCUMENT_GIVED_DATE);
                        $("#documentNumber").val(data.DOCUMENT_NUMBER);
                        $("#documentGivedBy").val(data.DOCUMENT_GIVED_BY);
                        $("#documentTypeId").val(data.DOCUMENT_TYPE_ID);
                        $('#documentTypeId').parent().remove();
                        $('<select>').appendTo('#doctypeField').addClass('docTypes datas field agentData').attr({
                            id: 'documentTypeId',
                            name: 'documentTypeId'
                        });
                        $("#documentTypeId").append(
                            $('<option>', {value: 4, text: "Вид на жительство"}),
                            $('<option>', {value: 1, text: "Удостоверение личности гражданина Казахстана"}),
                            $('<option>', {value: 2, text: "Паспорт гражданина Казахстана"})
                        );
                        $('#documentTypeId').val(data.DOCUMENT_TYPE_ID);
                        $("#block1").show();
                        App.UI("#doctypeField");

                    } else {
                        if (data.code === 404) {
                            showError('{{__('navbar.inn_not_found')}}');
                            $("#block1").hide();
                            $("#block2").hide();
                            $("#block3").hide();
                            $("#calculateSum").hide();

                        }else if (data.code === 406){
                            showError('{{__('navbar.no_older_than_65_years')}}');
                            $("#block1").hide();
                            $("#block2").hide();
                            $("#block3").hide();
                            $("#calculateSum").hide();
                        }
                        else {
                            showError('{{__('navbar.server_access_error')}}');
                        }
                        $('#overLoader').hide()
                    }
                }
            });
        }
    });


    function showBlock1() {

        var firstName = $("#firstName").val();
        var born = $("#born").val();
        var documentGivedDate = $("#documentGivedDate").val();
        var documentNumber = $("#documentNumber").val();
        var documentGivedBy = $("#documentGivedBy").val();
        var documentTypeId = $("#documentTypeId").val();

        let a = false;

        if (firstName == '') {
            a = true;
        }

        if (born == '') {
            a = true;
        }

        if (documentGivedDate == '') {
            a = true;
        }

        if (documentNumber == '') {
            a = true;
        }
        if (documentGivedBy == '') {
            a = true;
        }
        if (documentTypeId == '') {
            a = true;
        }

        if (a) return false;
        $("#block1").show();
    }


    // Show block 2

    function showBlock2() {

        var dataBeg = $("#dateBeg").val();

        let a = false;

        if (dataBeg.length !== 10) {
            a = true;
        }
        if ($("#programISN").val() < 1) {
            a = true;
        }

        if (a) return false;
        $("#programISN option[value='0']").remove()
        $("#block2").show();


    }

    function showBlock3() {

        var email = $("#email").val();
        var phone = $("#phone").val().replace(/\D+/g, "");


        let a = false;

        if (email.length < 5 && $('.email-field').css('display') != 'none') {
            a = true;

        }

        if (phone.length < 10) {
            a = true;

        }

        if (a) return false;
        $("#block3").show();
        $("#calculateSum").show();
    }




    $(".sms").on('change', function() {


        if ($("#notificationISN").val() == 898811) {

            $(".email-field").show();
            $("#phone-field").attr('class', 'col col--6-12');


        } else if ($("#notificationISN").val() == 898821) {

            $(".email-field").show();
            $("#phone-field").attr('class', 'col col--6-12');

        } else if ($("#notificationISN").val() == 898831) {

            $(".email-field").hide();
            $("#phone-field").attr('class', 'col col-12');


        } else if ($("#notificationISN").val() == 898841) {

            $(".email-field").show();
            $("#phone-field").attr('class', 'col col--6-12');

        } else if ($("#notificationISN").val() == 898851) {

            $(".email-field").hide();
            $("#phone-field").attr('class', 'col col--12-12');

        }

    });

    //ProgramISN get limitSum

    $("#programISN").on('change', async function () {
        $.ajax({
            type: 'POST',
            url: "{{route('covid.getProgramIsn')}}",
            dataType: "json",
            data: {
                programISN: $("#programISN").val(),
                _token: '{{csrf_token()}}'
            },
            beforeSend: function () {

            },

            success: await function (data) {
                if (data.code == 200) {
                    $('#overLoader').hide()
                    $("#limitSum").val(data.limitSum);
                }
            }
        });
    });


    // Делаем disabled прошедшие дни и текущий

    var today = new Date();
    var startDate = new Date();
    startDate.setDate(today.getDate() + 7);
    $(function () {

        $("#dateBeg").datepicker({
            minDate: new Date(),
            minDate: startDate,
            clearButton: true,
        });

        $('.edate').datepicker({
            onSelect: function (date, e, calendar) {
                calendar.hide();
            }
        });

        $('#dateBeg').datepicker({
            onSelect: function (date, e, calendar) {
                calendar.hide();
                validateData();
                showBlock2();
            }
        });

        $('#dateBeg').on("change", function () {
            validateData();

        })

        $('.dateBegChange').datepicker({
            onSelect: function (date, e, calendar) {
                calendar.hide();
                showBlock2();

                $("#nextStepShow").hide();
                $("#sendLinkShow").hide();
                $("#sendOrder").prop("disabled", false);

                var parts = $('#dateBeg').val().split(".");
                var day = parts[0] && parseInt(parts[0], 10);
                var month = parts[1] && parseInt(parts[1], 10);
                var year = parts[2] && parseInt(parts[2], 10);

                if (day <= 31 && day >= 1 && month <= 12 && month >= 1) {

                    var expiryDate = new Date(year, month - 1, day);
                    expiryDate.setFullYear(expiryDate.getFullYear() + 1);
                    expiryDate.setDate(expiryDate.getDate() - 1);

                    var day = ('0' + expiryDate.getDate()).slice(-2);
                    var month = ('0' + (expiryDate.getMonth() + 1)).slice(-2);
                    var year = expiryDate.getFullYear();

                    $("#dateEnd").val(day + "." + month + "." + year);
                }
            }
        });


        $('#born').datepicker({
            onSelect: function (date, e, calendar) {
                calendar.hide();
                $("#born_error").hide();
            }
        });

        $('#documentGivedDate').datepicker({
            onSelect: function (date, e, calendar) {
                calendar.hide();
                $("#documentGivedDate_error").hide();
            }
        });
    });


    // Валидация даты

    function validateData() {

        var errors = '';

        if ($("#dateBeg").val() == '') {
            $("#dateBeg_error").html('{{__('navbar.dateBeg_error_empty_data')}}' + $("#dateBeg").val()).show();
            return false;
        }

        var regEx = /^([0-9]{2})\.([0-9]{2})\.([0-9]{4})$/;

        if (!regEx.test($("#dateBeg").val())) {
            $("#dateBeg_error").html('{{__('navbar.wrong_date_format')}}').show();
            return false;
        }

        var d = new Date();
        var month = d.getMonth() + 1;
        var day = d.getDate() + 7;
        var nowDate = d.getFullYear() + (month < 10 ? '0' : '') + month + (day < 10 ? '0' : '') + day;
        var splitted = $("#dateBeg").val().split('.');
        var dateBeg = splitted[2] + splitted[1] + splitted[0];

        var maxDate = new Date();
        maxDate.setDate(maxDate.getDate() + 90);
        var maxMonth = maxDate.getMonth() + 1;
        var maxDay = maxDate.getDate() + 7;
        var futureDate = maxDate.getFullYear() + (maxMonth < 10 ? '0' : '') + maxMonth + (maxDay < 10 ? '0' : '') + maxDay;
        var beg = $("#dateBeg").val();
        var begSplit = beg.split('.');
        var begDate = begSplit[2] + begSplit[1] + begSplit[0];


        var end = $("#dateEnd").val();
        var endSplit = end.split('.');
        var endDate = endSplit[2] + endSplit[1] + endSplit[0];


        if (dateBeg < nowDate) {
            $("#dateBeg_error").show().html('{{__('navbar.dateBeg_error_seven_days')}}');
            $("#dateEnd").val("");
            return false;
        } else if (dateBeg > futureDate) {
            $("#dateBeg_error").show().html('{{__('navbar.dateBeg_error_ninety_days')}}');
            $("#dateEnd").val("");
            return false;
        }
        $("#dateBeg_error").hide();

        var parts = $('#dateBeg').val().split(".");
        var day = parts[0] && parseInt(parts[0], 10);
        var month = parts[1] && parseInt(parts[1], 10);
        var year = parts[2] && parseInt(parts[2], 10);

        if (day <= 31 && day >= 1 && month <= 12 && month >= 1) {

            var expiryDate = new Date(year, month - 1, day);
            expiryDate.setFullYear(expiryDate.getFullYear() + 1);
            expiryDate.setDate(expiryDate.getDate() - 1);

            var day = ('0' + expiryDate.getDate()).slice(-2);
            var month = ('0' + (expiryDate.getMonth() + 1)).slice(-2);
            var year = expiryDate.getFullYear();

            $("#dateEnd").val(day + "." + month + "." + year);

        }
        return true;
    }


</script>
