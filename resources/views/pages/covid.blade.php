@extends('layouts.general')

@section('content')

    <form action="{{route('covid.setOrder')}}" method="POST" id="covidForm">
        @csrf
        <div class="calculator__block bg-grey entry agentBlock agentHasError" id="section1">
            @include('mini_parts.overloader')
            <h3 class="calculator__title col--12-12 p-3">
                Личные данные</h3>
            <div class="grid">
                <div id="ajax"></div>
                <!-- ИИН -->
                <div class="col--12-12">
                    <fieldset class="field-set col col--6-12" style="false">
                        <label for="orderIIN" class="field-set__label checkList">ИИН <span id="noticeIIN1"
                                                                                           style="display: none;">(при наличии)</span>
                        </label>
                        <input class="field field datas iins" id="iin"
                               type="" name="iin" value="{{$dataUrl['subjects'][0]['user']['iin'] ?? ''}}"
                               maxlength="12" onkeyup="showOrHideBlock('iin_error','iin')">
                        <strong><small id="iin_error" class="form-text text-" style="display: none; color: crimson">
                                Вы не указали ваш иин</small></strong>
                    </fieldset>
                </div>
            </div>


            <div class="grid">

                <!-- Имя -->

                <fieldset class="field-set col col--3-12" style="false">
                    <label for="orderfirstName" class="field-set__label checkList">Имя </label>
                    <input class="field datas keyboardInput agentData1" type="text" name="firstName" id="firstName"
                           onkeyup="showOrHideBlock('firstName_error','firstName')"
                           value="{{$dataUrl['subjects'][0]['user']['first_name'] ?? ''}}">
                    <strong><small id="firstName_error" class="form-text text-" style="display: none; color: crimson">
                            Вы не указали ваше имя</small></strong>
                </fieldset>


                <!-- Фамилия -->

                <fieldset class="field-set col col--3-12 " style="false">
                    <label for="orderlastName" class="field-set__label checkList">Фамилия </label>
                    <input class="field datas keyboardInput agentData1" type="text"
                           name="lastName" id="lastName" value="{{$dataUrl['subjects'][0]['user']['last_name'] ?? ''}}"
                           onkeyup="showOrHideBlock('lastName_error','lastName')">
                    <strong><small id="lastName_error" class="form-text text-" style="display: none; color: crimson">
                            Вы не указали вашу фамилию</small></strong>
                </fieldset>

                <!-- Отчество -->

                <fieldset class="field-set col col--3-12" style="false">
                    <label for="patronymicName" class="field-set__label checkList">Отчество</label>
                    <input class="field datas keyboardInput agentData1" type="text"
                           name="patronymicName" id="patronymicName"
                           onkeyup="showOrHideBlock('patronymicName_error','patronymicName')"
                           value="{{$dataUrl['subjects'][0]['user']['patronymic_name'] ?? ''}}">
                    <strong><small id="patronymicName_error" class="form-text text-"
                                   style="display: none; color: crimson">
                            Вы не указали ваше отчество</small></strong>
                </fieldset>

                <!-- Дата рождения -->

                <fieldset class="field-set col col--3-12" style="false">
                    <label for="orderDocDate" class="field-set__label checkList">Дата рождения </label>
                    <input class="field field--date datas edate" id="born" type="tel"
                           name="born" maxlength="10" placeholder="dd.mm.yyyy"
                           onkeyup="showOrHideBlock('born_error','born')"
                           value="{{$dataUrl['subjects'][0]['user']['born'] ?? ''}}" autocomplete="off">
                    <strong><small id="born_error" class="form-text text-" style="display: none; color: crimson">
                            Вы не указали дату рождения</small></strong>
                </fieldset>

            </div>

            <div class="grid">
                <!-- Тип документа -->
                <fieldset class="field-set col col--3-12" id="fieldDocType1">
                    <div id="doctypeField">
                        <label for="orderBenefit" class="field-set__label checkList">Тип документа </label>
                        <select name="documentTypeId" id="documentTypeId" tabindex="-1"
                                class="benefits datas agentData1 field">
                            <option value="documentTypeId-empty">--</option>
                            <option
                                value="1" {{ 'Удостоверение личности гражданина Казахстана' == ($dataUrl['subjects'][0]['user']['document_class_name'] ?? '') ? 'selected' : ''}}>
                                Удостоверение личности гражданина Казахстана
                            </option>
                            <option
                                value="2" {{ 'Паспорт гражданина Казахстана' == ($dataUrl['subjects'][0]['user']['document_class_name'] ?? '') ? 'selected' : ''}}>
                                Паспорт гражданина Казахстана
                            </option>
                            <option
                                value="4" {{ 'Вид на жительство' == ($dataUrl['subjects'][0]['user']['document_class_name'] ?? '') ? 'selected' : ''}}>
                                Вид на жительство
                            </option>
                        </select>
                    </div>
                </fieldset>

                <!-- Номер документа -->

                <fieldset class="field-set col col--3-12" style="false">
                    <label for="orderDocNumber" class="field-set__label checkList">
                        Номер документа </label>
                    <input class="field field-- datas" id="documentNumber" type="text" name="documentNumber"
                           onkeyup="showOrHideBlock('documentNumber_error','documentNumber')" value="{{$dataUrl['subjects'][0]['user']['document_number'] ?? ''}}">
                    <strong><small id="documentNumber_error" class="form-text text-"
                                   style="display: none; color: crimson">
                            Вы не указали номер документа</small></strong>
                </fieldset>

                <!-- Дата выдачи документа -->

                <fieldset class="field-set col col--3-12" style="false">
                    <label for="documentGivedDate" class="field-set__label checkList">Дата выдачи документа </label>
                    <input class="field field--date datas edate" id="documentGivedDate"
                           name="documentGivedDate" maxlength="10" placeholder="dd.mm.yyyy"
                           onkeyup="showOrHideBlock('documentGivedDate_error','documentGivedDate')"
                           value="{{$dataUrl['subjects'][0]['user']['document_gived_date'] ?? ''}}" autocomplete="off">
                    <strong><small id="documentGivedDate_error" class="form-text text-"
                                   style="display: none; color: crimson">
                            Вы не указали когда выдан</small></strong>
                </fieldset>

                <!-- Кем выдан -->

                <fieldset class="field-set col col--3-12">
                    <label for="orderdocumentGivedBy" class="field-set__label checkList">Кем выдан </label>
                    <input class="field datas keyboardInput agentData1" id="documentGivedBy" type="text"
                           name="documentGivedBy" maxlength="10"
                           onkeyup="showOrHideBlock('documentGivedBy_error','documentGivedBy')"
                           value="{{$dataUrl['subjects'][0]['user']['document_gived_by'] ?? ''}}" autocomplete="off">
                    <strong><small id="documentGivedBy_error" class="form-text text-"
                                   style="display: none; color: crimson">
                            Вы не указали кем выдан</small></strong>
                </fieldset>
            </div>

            <div class="grid">

                <!-- Застрахованный является Страхователем -->

                <fieldset class="field-set col col--4-12">
                    <label class="field-set__label"></label>
                    <label class="checkbox">
                        <input type="checkbox" name="insuredInsurer" id="insuredInsurer" value="yes"
                               class="checkbox-cov"
                               checked="checked" disabled>
                        <span class="checkbox__label">Застрахованный является Страхователем</span>
                    </label>
                </fieldset>

                <!-- НЕ является  резидентом США -->

                <fieldset class="field-set col col--6-12">
                    <label class="field-set__label"></label>
                    <label class="checkbox">
                        <input type="checkbox" name="notResidentUSA" id="notResidentUSA" value="no" class="checkbox-cov"
                               checked="checked">
                        <span
                            class="checkbox__label">Застрахованный  НЕ является  резидентом США/Гражданином США</span>
                    </label>
                </fieldset>
            </div>


            <div class="grid" id="block1" style="display: none">

                <!-- Программа -->

                <fieldset class="field-set col col--6-12">
                    <label for="orderBenefit" class="field-set__label">Программа</label>
                    <select name="programISN" id="programISN" tabindex="-1" onchange="showBlock2()"
                            class="benefits datas agentData1 field">
                        <option value="0">--</option>
                        <option value="898641" {{ 898641 == ($dataUrl['programISN'] ?? '') ? 'selected' : ''}}>Прогрмма
                            1
                        </option>
                        <option value="898651" {{ 898651 == ($dataUrl['programISN'] ?? '') ? 'selected' : ''}}>Прогрмма
                            2
                        </option>
                        <option value="898661" {{ 898661 == ($dataUrl['programISN'] ?? '') ? 'selected' : ''}}>Прогрмма
                            3
                        </option>
                    </select>
                </fieldset>

                <!--    Страховая сумма -->

                <fieldset class="field-set col col--6-12">
                    <label for="orderEmail" class="field-set__label checkList">
                        Страховая сумма</label>
                    <input type="text" class="field datas keyboardInput agentData1" id="limitSum"
                           name="limitSum" disabled
                           value="{{$dataUrl['limitSum'] ?? ''}}">
                </fieldset>

                <!-- Дата начала договора -->

                <fieldset class="field-set col col--6-12" style="false">
                    <div id="forAgrBeg">
                        <h3 class="col--12-12">Дата начала договора</h3>
                        <input class="field field--date edate dateBeg col--6-12" id="dateBeg" type="text" name="dateBeg"
                               maxlength="10" placeholder="dd.mm.yyyy" onchange="showBlock2()" onkeypress="showBlock2()"
                               onkeyup="showOrHideBlock('dateBeg_error','dateBeg')"
                               value="{{$dataUrl['dateBeg'] ?? ''}}" autocomplete="off">
                        <strong><small id="dateBeg_error" class="form-text text-" style="display: none; color: crimson">
                                Вы не указали дату</small></strong>
                    </div>
                </fieldset>

                <!-- Дата окончания договора -->

                <fieldset class="field-set col col--6-12" style="false">
                    <h3 class="col--12-12">Дата окончания договора</h3>
                    <input class="field col--6-12 edate dateEnd field--date" id="dateEnd" type="text" name="dateEnd"
                           maxlength="10" value="{{$dataUrl['dateEnd'] ?? ''}}" placeholder="dd.mm.yyyy"
                           autocomplete="off" disabled="">
                </fieldset>

            </div>

            <div class="grid" id="block2" style="display: none">

                <fieldset class="field-set col col--full" style="false">
                    <label for="orderBenefit" class="field-set__label">
                        Способ уведомления</label><select
                        name="notificationISN" id="notificationISN" tabindex="-1"
                        class="benefits datas agentData1 field">
                        <option value="notification-empty">--</option>
                        <option value="898811" {{ 898811 == ($dataUrl['notificationISN'] ?? '') ? 'selected' : ''}}>
                            Email от Коммеска + Email от ЕСБД
                        </option>
                        <option value="898821" {{ 898821 == ($dataUrl['notificationISN'] ?? '') ? 'selected' : ''}}>
                            Email от Коммеска + SMS от ЕСБД
                        </option>
                        <option value="898831" {{ 898831 == ($dataUrl['notificationISN'] ?? '') ? 'selected' : ''}}>SMS от ЕСБД
                        </option>
                        <option value="898841" {{ 898841 == ($dataUrl['notificationISN'] ?? '  ') ? 'selected' : ''}}>SMS от Коммеска + Email от ЕСБД
                        </option>
                        <option value="898851" {{ 898851 == ($dataUrl['notificationISN'] ?? '') ? 'selected' : ''}}>SMS от Коммеска + SMS от ЕСБД
                        </option>
                    </select>
                </fieldset>

                <!-- Мобильный номер -->

                <fieldset class="field-set col col--6-12">
                    <label for="orderPhone" class="field-set__label checkList">
                        Мобильный телефон </label>
                    <input type="tel" class="field interTel datas phone_number" id="phone" name="phone"
                           onkeyup="showOrHideBlock('phone_error','phone')" onchange="showBlock3()" value="{{$dataUrl['phone'] ?? ''}}">
                    <strong><small id="phone_error" class="form-text text-" style="display: none; color: crimson">
                            Вы не указали телефон</small></strong>
                </fieldset>

                <!-- E-Mail -->

                <fieldset class="field-set col col--6-12">
                    <label for="orderEmail" class="field-set__label checkList">
                        E-Mail </label>
                    <input type="text" class="field datas keyboardInput agentData1" id="email" name="email"
                           onkeyup="showOrHideBlock('email_error','email')" onchange="showBlock3()" value="{{$dataUrl['email'] ?? ''}}">
                    <strong><small id="email_error" class="form-text" style="display: none; color: crimson">
                            Вы не указали email</small></strong>
                </fieldset>

            </div>
        </div>



        <!-- Анкета -->  <!-- Анкета -->  <!-- Анкета -->

        <div class="calculator__section calculator__section--special badkasko" id="block3" style="display: none">
            <div class="calculator__block calculator__block--special">
                <h3 class="calculator__title">Анкета</h3>
                <div class="grid">

                    <!-- Имеет ли Застрахованный инвалидность? -->

                    <div class="col-50 col col--6-12">
                        <div class="checkbox-enhanced">
						<span>
							<h5>
								<label for="calcPlus" class="checkbox">
									<label for="hasInvalid" class="checkbox">
									<input type="checkbox" class="checkbox-cov" name="hasInvalid" value=""
                                           id="hasInvalid" onclick="checkbox()">
                                        <span class="checkbox__label">Имеет ли Застрахованный инвалидность?</span>
                                    </label>
								</label>
							</h5>
						</span>
                        </div>
                    </div>

                    <!-- Состоит ли Застрахованный на учете в психоневрологическом диспансере? -->

                    <div class="col-50 col col--6-12">
                        <div class="checkbox-enhanced">
						<span>
							<h5>
								<label for="hasPsycho" class="checkbox">
									<input type="checkbox" name="hasPsycho" value="" id="hasPsycho"
                                           class="checkbox-cov"  onclick="checkbox()" >
                                    <span class="checkbox__label">Состоит ли Застрахованный на учете в психоневрологическом диспансере?</span>
                                </label>
							</h5>
						</span>
                        </div>
                    </div>

                    <!-- Занимается ли Застрахованный спортом? -->

                    <div class="col-50 col col--6-12">
                        <div class="checkbox-enhanced">
						<span>
							<h5>
								<label for="hasSport" class="checkbox">
									<input type="checkbox" name="hasSport" value="" id="hasSport"
                                           class="checkbox-cov"  onclick="checkbox()">
                                    <span class="checkbox__label">Занимается ли Застрахованный спортом?</span>
                                </label>
							</h5>
						</span>
                        </div>
                    </div>

                    <!-- Имеет ли Застрахованный хронические или наследственные заболевания? -->

                    <div class="col-50 col col--6-12">
                        <div class="checkbox-enhanced">
						<span>
							<h5>
                <label for="hasChronic" class="checkbox">
                    <input type="checkbox" name="hasChronic" value="" id="hasChronic" class="checkbox-cov"  onclick="checkbox()">
                    <span
                        class="checkbox__label">Имеет ли Застрахованный хронические или наследственные заболевания?</span>
                </label>
							</h5>
						</span>
                        </div>
                    </div>

                    <!-- Является ли Застрахованный лицом,
                       отбывающим наказание за совершение уголовных преступлений -->

                    <div class="col-50 col col--6-12">
                        <div class="checkbox-enhanced">
                                <span>
                                    <h5>
                         <label for="hasCriminal" class="checkbox">
                     <input type="checkbox" name="hasCriminal" value="" id="hasCriminal" class="checkbox-cov"  onclick="checkbox()">
                    <span class="checkbox__label">
                     Является ли Застрахованный лицом,
                   отбывающим наказание за совершение уголовных преступлений
                   в учреждениях уголовно-исполнительной системы?
              </span>
               </label></h5>
                                </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="calculator__section" id="calculateSum" style="display: none">
            <div class="calculator__block bg-grey">
                <div class="grid">
                    <div class="col col--6-12">
                        <button type="submit" id="sendOrder"
                                class="button button--prime">
                            Рассчитать
                        </button>
                        <div style="display: none; font-weight: bold" id="premiumWrapper">
                            Итого:<span id="premium" class="premium" style="font-size: larger;"></span> тг
                            <input type="hidden" id="bornHidden"
                                   value="{{$dataUrl['subjects'][0]['user']['born'] ?? ''}}">
                            <input type="hidden" id="documentGivedDateHidden"
                                   value="{{$dataUrl['subjects'][0]['user']['document_gived_date'] ?? ''}}">
                            <input type="hidden" id="dateBegHidden" value="{{$dataUrl['dateBeg'] ?? ''}}">
                            <input type="hidden" id="dateEndHidden" value="{{$dataUrl['dateEnd'] ?? ''}}">
                            <input type="number" name="order_id" id="order_id"
                                   value="" style="display: none">
                            <input type="text" name="hash" id="hash"
                                   value="" style="display: none">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>


    <!-- Начало Скрипта -->

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://unpkg.com/imask"></script>
    <script type="text/javascript">

        // возврат оишбок в формате json через модальное окно

        function showError(text) {
            $('#modalText').html(text);
            $('#modalError').modal('show');
        }

        function checkbox(){
            if($(".checkbox-cov").attr("checked") === 'checked') {
                showError("You have trouble broooo!");
                return false;
            }
            return true;
        }
        // функция для скрытия ошибок после заполения поля

        function showOrHideBlock(errorBlock, manipulationBlock) {
            $('#' + errorBlock).hide();
        }

        //

        $(document).ready(function () {
            $('.edate').datepicker({
                dateFormat: "dd.mm.yyyy"
            });

            // Определение полей checkboxes

            $('#covidForm').submit(async function (event) {
                event.preventDefault();
                var checkboxes = '';
                $(".checkbox-cov").each(function () {
                    if ($(this).is(':checked')) {
                        checkboxes = checkboxes + $(this).attr('id') + "=yes&";
                    } else {
                        checkboxes = checkboxes + $(this).attr('id') + "=no&";
                    }

                });

                /////// определяем переменные для проверки полей на пустоту

                var iin = $("#iin").val();
                var firstName = $("#firstName").val();
                var lastName = $("#lastName").val();
                var patronymicName = $("#patronymicName").val();
                var phone = $("#phone").val();
                var email = $("#email").val();
                var dateBeg = $("#dateBeg").val();
                var born = $("#born").val();
                var documentGivedDate = $("#documentGivedDate").val();
                var documentNumber = $("#documentNumber").val();
                var documentGivedBy = $("#documentGivedBy").val();

                // Сохраням данные в БД

                $.ajax({
                    type: 'POST',
                    url: "{{route('covid.setOrder')}}",
                    dataType: "json",
                    data: {
                        iin: $("#iin").val(),
                        checkboxes: checkboxes,
                        order_id: $("#order_id").val(),
                        hash: $("#hash").val(),
                        firstName: $("#firstName").val(),
                        lastName: $("#lastName").val(),
                        patronymicName: $("#patronymicName").val(),
                        phone: $("#phone").val(),
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

                        if (iin == '') {
                            $("#iin_error").show();
                            a = true;
                        }
                        if (firstName == '') {
                            $("#firstName_error").show();
                            a = true;
                        }

                        if (phone == '') {
                            $("#phone_error").show();
                            a = true;
                        }

                        if (email == '') {
                            $("#email_error").show();
                            a = true;
                        }

                        if (dateBeg == '' || !validateData()) {
                            $("#dateBeg_error").show();
                            a = true;
                        }

                        if (documentGivedDate == '') {
                            $("#documentGivedDate_error").show();
                            a = true;
                        }

                        if (documentNumber == '') {
                            $("#documentNumber_error").show();
                            a = true;
                        }
                        if (documentGivedBy == '') {
                            $("#documentGivedBy_error").show();
                            a = true;
                        }

                        if (born == '') {
                            $("#born_error").show();
                            a = true;
                        }
                        if (a) return false;
                        $('#overLoader').show();
                    },
                    success: await function (data) {
                        if (data.code == 200) {
                            $('#overLoader').hide()
                            $("#order_id").val(data.order_id);
                            $("#hash").val(data.hash);
                            $("#premium").html(data.premium);
                            $('#premiumWrapper').show();
                            $('#premium').text((i, text) => {
                                const [premium] = text.split(' ');
                                return `${(+premium).toLocaleString('ru-RU')}`;
                            });
                            history.pushState({}, '', "?productOrderId=" + data.order_id + "&hash=" + data.hash + "&step=1");
                        } else {
                            showError(data.error);
                            $('#overLoader').hide()
                        }
                    },
                    fail: await function () {
                        showError("Ошибка доступа к серверу, попробуйте позже");
                        $('#overLoader').hide()
                    }
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

        // Маска для поля phone

        var phoneMask = IMask(
            document.getElementById('phone'), {
                mask: '+{7}(000)000-00-00'
            });

        // Валидация поля ИИН

        document.oninput = function () {
            var input = document.querySelector('.iins');
            input.value = input.value.replace(/\D/g, '');
        }

        // После заполнения поля ИИН тянем данные с Kias

        $(".iins").on('keypress change', async function () {
            var iin = $("#iin").val();
            $(".form-text").hide();
            if (iin.length == 12) {
                $.ajax({
                    type: 'POST',
                    url: "{{route('covid.getClient')}}",
                    dataType: "json",
                    data: {
                        iin: iin,
                        _token: '{{csrf_token()}}'
                    },
                    beforeSend: function () {
                        $('#overLoader').show();
                    },
                    success: await function (data) {
                        $('#overLoader').hide()
                        if (data.code == 200) {
                            data = data.client;
                            $("#lastName").val(data.Last_Name);
                            $("#firstName").val(data.First_Name);
                            $("#patronymicName").val(data.Patronymic_Name);
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
                            App.UI("#doctypeField");

                        }
                    }
                });
            }
        });

        // Show block 1

        $(".iins").on('keypress change', function () {
            var iin = $("#iin").val();
            if (iin.length == 12) {
                $("#block1").show();
            }
        });

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
            $("#block2").show();

        }

        // Show block 3

        function showBlock3() {

            var email = $("#email").val();
            var phone = $("#phone").val();

            let a = false;

            if (email == '') {
                a = true;

            }

            if (phone == '') {
                a = true;

            }

            if (a) return false;
            $("#block3").show();
            $("#calculateSum").show();

        }


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


            $('#born').datepicker({
                onSelect: function (date, e, calendar) {
                    calendar.hide();
                    console.log("born");
                    $("#born_error").hide();
                }
            });
        });


        // Валидация даты

        function validateData() {

            var errors = '';

            if ($("#dateBeg").val() == '') {
                $("#dateBeg_error").html('Заполните Дату' + $("#dateBeg").val()).show();
                return false;
            }

            var regEx = /^([0-9]{2})\.([0-9]{2})\.([0-9]{4})$/;

            if (!regEx.test($("#dateBeg").val())) {
                $("#dateBeg_error").html('Неверный формат даты').show();
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
                $("#dateBeg_error").show().html("Дата начала действия договора должна быть минимум на 7 дней " +
                    " больше текущей." +
                    " Пожалуйста, скорректируйте");
                return false;
            } else if (dateBeg > futureDate) {
                $("#dateBeg_error").show().html("Максимальное количество дней ДО даты начала договора " +
                    "- 90 от текущей даты. Пожалуйста, скорректируйте");
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

    <!-- Button trigger modal -->

    <div class="modal fade" id="modalError" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p id="modalText" style="color: crimson;"></p>
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
