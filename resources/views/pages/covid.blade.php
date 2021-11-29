@extends('layouts.general')

@section('content')
    <div class="calculator__block bg-grey entry agentBlock" id="section1">
        <div class=""></div>
        <h3 class="calculator__title">
            Личные данные</h3>
        <div class="grid">
            <div id="ajax"></div>


            <!-- ИИН -->
            <form action="{{route('covid.setOrder')}}" method="POST" id="covidFrom">
                @csrf
                <div class="grid">
                    <div id="ajax"></div>
                    <!-- ИИН -->
                    <div class="col--12-12">
                        <fieldset class="field-set col col--6-12" style="false">
                            <label for="orderIIN" class="field-set__label checkList">
                                ИИН
                                <span style="display: none;">(при наличии)</span>
                            </label>
                            <input class="field field datas iins" id="iin"
                                   type="" name="iin" maxlength="12">
                        </fieldset>
                    </div>
                    <div id="overLoader" class="wheel-loading" style="display: none; ">
                        <img src="{{ asset('images/ajax-loader.gif') }}" alt="Loading..."></div>
                    <!-- Имя -->
                    <fieldset class="field-set col col--3-12" style="false">
                        <label for="orderfirstName" class="field-set__label checkList">
                            Имя
                        </label>
                        <input class="field datas keyboardInput agentData1" type="text" name="firstName" id="firstName" value="">
                    </fieldset>

                    <!-- Фамилия -->
                    <fieldset class="field-set col col--3-12 " style="false">
                        <label for="orderlastName" class="field-set__label checkList">
                            Фамилия
                        </label>
                        <input class="field datas keyboardInput agentData1" type="text"
                               name="lastName" id="lastName" value="">
                        <div class="small col keyboardInput">
                            <span class="error" id="checkLastName1">
                            </span>
                        </div>
                    </fieldset>

                    <!-- Отчество -->
                    <fieldset class="field-set col col--3-12" style="false">
                        <label for="orderMIDDLE_NAME" class="field-set__label checkList">
                            Отчество
                        </label>
                        <input class="field datas keyboardInput agentData1" type="text"
                               name="patronymicName" id="patronymicName" value="">
                    </fieldset>

                    <!-- ДР -->
                    <fieldset class="field-set col col--3-12" style="false">
                        <label for="orderDocDate" class="field-set__label checkList">
                            День рождение
                        </label>
                        <input class="field field--date datas edate" id="born" type="tel"
                               name="born" maxlength="10" placeholder="dd.mm.yyyy" value="" autocomplete="off">
                    </fieldset>


                    <!--  Номер документа	 -->

                    <fieldset class="field-set col col--3-12" style="false">
                        <label for="orderDocNumber" class="field-set__label checkList">
                            Номер документа
                        </label>
                        <input class="field field-- datas" id="documentNumber" type="text"
                               name="documentNumber" value="">
                        <div class="small col" id="checkDocNumber1"></div>
                    </fieldset>


                    <!-- Тип документа	 -->

                    <fieldset class="field-set col col--3-12" id="fieldDocType1">
                        <label for="orderDocType" class="field-set__label checkList">
                            Тип документа </label>
                        <select
                            name="docType[]" id="docType1" tabindex="-1" class="docTypes datas agentData1 field">
                            <option value="v0-empty">--</option>
                            <option value="1144">Вид на жительство</option>
                            <option value="1165" selected="">Удостоверение личности гражданина Казахстана</option>
                            <option value="1156">Паспорт гражданина Казахстана</option>
                        </select>
                    </fieldset>

                    <!-- Дата выдачи документа -->
                    <fieldset class="field-set col col--3-12" style="false">
                        <label for="orderDocDate" class="field-set__label checkList">
                            Дата выдачи документа
                        </label>
                        <input class="field field--date datas edate" id="documentGivedDate" type="tel"
                               name="documentGivedDate" maxlength="10" placeholder="dd.mm.yyyy" value=""
                               autocomplete="off">
                    </fieldset>

                    <!-- Кем выдан	 -->

                    <fieldset class="field-set col col--3-12" style="false">
                        <label for="orderdocumentGivedBy" class="field-set__label checkList">
                            Кем выдан
                        </label>
                        <input class="field datas keyboardInput agentData1" id="documentGivedBy" type="text"
                               name="documentGivedBy" maxlength="10" value="" autocomplete="off">
                    </fieldset>

                </div>


                <div class="grid">
                    <fieldset class="field-set col col--4-12">
                        <label class="field-set__label"></label>
                        <label class="checkbox">
                            <input type="checkbox" name="insured[]" id="insured1" value="yes" class="datas agentData1" checked="checked" disabled>
                            <span class="checkbox__label">Застрахованный является Страхователем</span>
                        </label>
                    </fieldset>

                    <fieldset class="field-set col col--6-12">
                        <label class="field-set__label"></label>
                        <label class="checkbox">
                            <input type="checkbox" name="insured[]" id="insured1" value="no" class="datas agentData1" checked="checked">
                            <span
                                class="checkbox__label">Застрахованный  НЕ является  резидентом США/Гражданином США</span>
                        </label>
                    </fieldset>
                </div>


                <h3 class="calculator__title">Анкета</h3>

                <div class="grid">

                    <div class="col-50 col col--6-12">
                        <div class="checkbox-enhanced">
						<span>
							<h5>
								<label for="calcPlus" class="checkbox">
									<input type="checkbox" name="calcPlus" value="yes" id="calcPlus" class="new-styler">
									<span class="checkbox__label">Имеет ли Застрахованный инвалидность?</span>
								</label>
							</h5>
						</span>
                        </div>

                    </div>

                    <div class="col-50 col col--6-12">
                        <div class="checkbox-enhanced">
						<span>
							<h5>
								<label for="calcCareless" class="checkbox">
									<input type="checkbox" name="calcCareless" value="yes" id="calcCareless"
                                           class="new-styler">
									<span class="checkbox__label">Состоит ли Застрахованный на учете в психоневрологическом диспансере?</span>
								</label>
							</h5>
						</span>
                        </div>
                    </div>

                    <div class="col-50 col col--6-12">
                        <div class="checkbox-enhanced">
						<span>
							<h5>
								<label for="calcPeople" class="checkbox">
									<input type="checkbox" name="calcPeople" value="yes" id="calcPeople"
                                           class="new-styler">
									<span class="checkbox__label">Занимается ли Застрахованный спортом?</span>
								</label>
							</h5>
						</span>
                        </div>
                    </div>

                    <div class="col-50 col col--6-12">
                        <div class="checkbox-enhanced">
						<span>
							<h5>
								<label for="calcGPO" class="checkbox">
									<input type="checkbox" name="calcGPO" value="yes" id="calcGPO" class="new-styler">
									<span class="checkbox__label">Имеет ли Застрахованный хронические или наследственные заболевания?</span>
								</label>
							</h5>
						</span>

                        </div>
                    </div>

                    <div class="grid">

                        <!--    Страховая сумма -->

                        <fieldset class="field-set col col--6-12">
                            <label for="orderEmail" class="field-set__label checkList">
                                Страховая сумма</label>
                            <input type="text" class="field datas keyboardInput agentData1" id="Calc_Sum"
                                   name="Calc_Sum"
                                   value="">
                            <div class="small col" id="checkEmail1"></div>
                            <p class="small text-grey">Период страхования - 12 месяцев</p>
                        </fieldset>

                        <!-- Программа -->

                        <fieldset class="field-set col col--6-12" style="false">
                            <label for="orderBenefit" class="field-set__label">
                                Программа</label>
                            <select
                                name="benefit[]" id="benefit1" tabindex="-1"
                                class="benefits datas agentData1 field">
                                <option value="v0-empty">--</option>
                                <option value="221721">Прогрмма 1</option>
                                <option value="221722">Прогрмма 2</option>
                                <option value="221720">Прогрмма 3</option>
                            </select>
                        </fieldset>


                        <fieldset class="field-set col col--6-12" style="false">
                            <h3 class="col">Дата начала договора</h3>
                            <input class="field field--date edate col--6-12" id="agrBeg" type="tel" name="agrBeg"
                                   maxlength="10" placeholder="dd.mm.yyyy" value="" autocomplete="off">
                            <br><span class="small error" style="display: none" id="textAgrBeg"></span>
                            <input type="hidden" id="ssid" value="939ae3ec9dc28ee495a304aa33396d48">
                        </fieldset>

                        <fieldset class="field-set col col--6-12" style="false">
                            <h3 class="col">Дата окончания договора</h3>
                            <input class="field col--6-12 edate field--date" id="agrEnd" type="tel" name="agrEnd"
                                   maxlength="10" value="" placeholder="dd.mm.yyyy" autocomplete="off" disabled="">
                        </fieldset>


                        <!-- Мобильный номер -->

                        <fieldset class="field-set col col--6-12">
                            <label for="orderPhone" class="field-set__label checkList">
                                Мобильный телефон </label>
                            <input type="tel" class="field interTel datas phone_number" id="phone" name="phone"
                                   value="">
                        </fieldset>

                        <!-- E-Mail -->
                        <fieldset class="field-set col col--6-12">
                            <label for="orderEmail" class="field-set__label checkList">
                                E-Mail </label>
                            <input type="text" class="field datas keyboardInput agentData1" id="email" name="email"
                                   value="">
                            <div class="small col" id="checkEmail1"></div>
                        </fieldset>

                    </div>


                    <fieldset class="field-set col col--full" style="false">
                        <label for="orderBenefit" class="field-set__label">
                            Способ уведомления</label><select
                            name="benefit[]" id="benefit1" tabindex="-1"
                            class="benefits datas agentData1 field">
                            <option value="v0-empty">--</option>
                            <option value="221721">Email от Коммеска + Email от ЕСБД</option>
                            <option value="221722">Email от Коммеска + SMS от ЕСБД</option>
                            <option value="221720">SMS от ЕСБД</option>
                            <option value="221719">SMS от Коммеска + Email от ЕСБД</option>
                            <option value="221723">SMS от Коммеска + SMS от ЕСБД</option>
                        </select>
                    </fieldset>

                    <fieldset class="field-set col col--4-12">
                        <br>
                        <button type="submit" class="button button--hollow agentClear" id="save">Расчитать</button>
                    </fieldset>
                </div>
            </form>
        </div>
    </div>




    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://unpkg.com/imask"></script>
    <script type="text/javascript">


        $(document).ready(function () {
            $('.edate').datepicker({
                dateFormat: "dd.mm.yyyy"
            });
            $('.edate').val("");
            $('#covidForm').submit(function (event) {
                event.preventDefault();
            });
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

        var phoneMask = IMask(
            document.getElementById('phone'), {
                mask: '+{7}(000)000-00-00'
            });
        6

        document.oninput = function () {
            var input = document.querySelector('.iins');
            input.value = input.value.replace(/\D/g, '');
        }

        $(".iins").on('keypress change', async function () {
            var iin = $("#iin").val();
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
                            $("#lastName").val(data.Last_Name)
                            $("#firstName").val(data.First_Name)
                            $("#patronymicName").val(data.Patronymic_Name)
                            $("#born").val(data.Born)
                            $("#documentGivedDate").val(data.DOCUMENT_GIVED_DATE)
                            $("#documentNumber").val(data.DOCUMENT_NUMBER)
                            $("#documentGivedBy").val(data.DOCUMENT_GIVED_BY)
                            $("#documentTypeId").val(data.DOCUMENT_GIVED_BY)
                        }
                    }
                });
            }
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



