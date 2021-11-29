@extends('layouts.general')

@section('content')


    <div class="calculator__block bg-grey entry agentBlock" id="section1">
        <div id="overLoader" class="overLoader" style="display: none;">
            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                 style="margin:auto;display:block;" width="60%" height="60%" viewBox="0 0 100 100"
                 preserveAspectRatio="xMidYMid">
                <circle cx="6.451612903225806" cy="50" r="3" fill="#d8b2d8">
                    <animate attributeName="r" times="0;0.5;1"
                             values="2.4000000000000004;3.5999999999999996;2.4000000000000004" dur="2s"
                             repeatCount="indefinite" begin="-0.5s"></animate>
                    <animate attributeName="cy" keyTimes="0;0.5;1" values="32;68;32" dur="2s" repeatCount="indefinite"
                             begin="0s" keySplines="0.5 0 0.5 1;0.5 0 0.5 1" calcMode="spline"></animate>
                    <animate attributeName="fill" keyTimes="0;0.5;1" values="#d8b2d8;#dcc2e2;#d8b2d8" dur="2s"
                             repeatCount="indefinite" begin="-0.5s"></animate>
                </circle>
                <circle cx="6.451612903225806" cy="50" r="3" fill="#9eccef">
                    <animate attributeName="r" times="0;0.5;1"
                             values="2.4000000000000004;3.5999999999999996;2.4000000000000004" dur="2s"
                             repeatCount="indefinite" begin="-1.5s"></animate>
                    <animate attributeName="cy" keyTimes="0;0.5;1" values="32;68;32" dur="2s" repeatCount="indefinite"
                             begin="-1s" keySplines="0.5 0 0.5 1;0.5 0 0.5 1" calcMode="spline"></animate>
                    <animate attributeName="fill" keyTimes="0;0.5;1" values="#9eccef;#62d1e7;#9eccef" dur="2s"
                             repeatCount="indefinite" begin="-0.5s"></animate>
                </circle>
                <circle cx="16.129032258064512" cy="50" r="3" fill="#d8b2d8">
                    <animate attributeName="r" times="0;0.5;1"
                             values="2.4000000000000004;3.5999999999999996;2.4000000000000004" dur="2s"
                             repeatCount="indefinite" begin="-0.7s"></animate>
                    <animate attributeName="cy" keyTimes="0;0.5;1" values="32;68;32" dur="2s" repeatCount="indefinite"
                             begin="-0.2s" keySplines="0.5 0 0.5 1;0.5 0 0.5 1" calcMode="spline"></animate>
                    <animate attributeName="fill" keyTimes="0;0.5;1" values="#d8b2d8;#dcc2e2;#d8b2d8" dur="2s"
                             repeatCount="indefinite" begin="-0.7s"></animate>
                </circle>
                <circle cx="16.129032258064512" cy="50" r="3" fill="#9eccef">
                    <animate attributeName="r" times="0;0.5;1"
                             values="2.4000000000000004;3.5999999999999996;2.4000000000000004" dur="2s"
                             repeatCount="indefinite" begin="-1.7s"></animate>
                    <animate attributeName="cy" keyTimes="0;0.5;1" values="32;68;32" dur="2s" repeatCount="indefinite"
                             begin="-1.2s" keySplines="0.5 0 0.5 1;0.5 0 0.5 1" calcMode="spline"></animate>
                    <animate attributeName="fill" keyTimes="0;0.5;1" values="#9eccef;#62d1e7;#9eccef" dur="2s"
                             repeatCount="indefinite" begin="-0.7s"></animate>
                </circle>
                <circle cx="25.806451612903224" cy="50" r="3" fill="#d8b2d8">
                    <animate attributeName="r" times="0;0.5;1"
                             values="2.4000000000000004;3.5999999999999996;2.4000000000000004" dur="2s"
                             repeatCount="indefinite" begin="-0.9s"></animate>
                    <animate attributeName="cy" keyTimes="0;0.5;1" values="32;68;32" dur="2s" repeatCount="indefinite"
                             begin="-0.4s" keySplines="0.5 0 0.5 1;0.5 0 0.5 1" calcMode="spline"></animate>
                    <animate attributeName="fill" keyTimes="0;0.5;1" values="#d8b2d8;#dcc2e2;#d8b2d8" dur="2s"
                             repeatCount="indefinite" begin="-0.9s"></animate>
                </circle>
                <circle cx="25.806451612903224" cy="50" r="3" fill="#9eccef">
                    <animate attributeName="r" times="0;0.5;1"
                             values="2.4000000000000004;3.5999999999999996;2.4000000000000004" dur="2s"
                             repeatCount="indefinite" begin="-1.9s"></animate>
                    <animate attributeName="cy" keyTimes="0;0.5;1" values="32;68;32" dur="2s" repeatCount="indefinite"
                             begin="-1.4s" keySplines="0.5 0 0.5 1;0.5 0 0.5 1" calcMode="spline"></animate>
                    <animate attributeName="fill" keyTimes="0;0.5;1" values="#9eccef;#62d1e7;#9eccef" dur="2s"
                             repeatCount="indefinite" begin="-0.9s"></animate>
                </circle>
                <circle cx="35.48387096774193" cy="50" r="3" fill="#d8b2d8">
                    <animate attributeName="r" times="0;0.5;1"
                             values="2.4000000000000004;3.5999999999999996;2.4000000000000004" dur="2s"
                             repeatCount="indefinite" begin="-1.1s"></animate>
                    <animate attributeName="cy" keyTimes="0;0.5;1" values="32;68;32" dur="2s" repeatCount="indefinite"
                             begin="-0.6s" keySplines="0.5 0 0.5 1;0.5 0 0.5 1" calcMode="spline"></animate>
                    <animate attributeName="fill" keyTimes="0;0.5;1" values="#d8b2d8;#dcc2e2;#d8b2d8" dur="2s"
                             repeatCount="indefinite" begin="-1.1s"></animate>
                </circle>
                <circle cx="35.48387096774193" cy="50" r="3" fill="#9eccef">
                    <animate attributeName="r" times="0;0.5;1"
                             values="2.4000000000000004;3.5999999999999996;2.4000000000000004" dur="2s"
                             repeatCount="indefinite" begin="-2.1s"></animate>
                    <animate attributeName="cy" keyTimes="0;0.5;1" values="32;68;32" dur="2s" repeatCount="indefinite"
                             begin="-1.6s" keySplines="0.5 0 0.5 1;0.5 0 0.5 1" calcMode="spline"></animate>
                    <animate attributeName="fill" keyTimes="0;0.5;1" values="#9eccef;#62d1e7;#9eccef" dur="2s"
                             repeatCount="indefinite" begin="-1.1s"></animate>
                </circle>
                <circle cx="45.16129032258064" cy="50" r="3" fill="#d8b2d8">
                    <animate attributeName="r" times="0;0.5;1"
                             values="2.4000000000000004;3.5999999999999996;2.4000000000000004" dur="2s"
                             repeatCount="indefinite" begin="-1.3s"></animate>
                    <animate attributeName="cy" keyTimes="0;0.5;1" values="32;68;32" dur="2s" repeatCount="indefinite"
                             begin="-0.8s" keySplines="0.5 0 0.5 1;0.5 0 0.5 1" calcMode="spline"></animate>
                    <animate attributeName="fill" keyTimes="0;0.5;1" values="#d8b2d8;#dcc2e2;#d8b2d8" dur="2s"
                             repeatCount="indefinite" begin="-1.3s"></animate>
                </circle>
                <circle cx="45.16129032258064" cy="50" r="3" fill="#9eccef">
                    <animate attributeName="r" times="0;0.5;1"
                             values="2.4000000000000004;3.5999999999999996;2.4000000000000004" dur="2s"
                             repeatCount="indefinite" begin="-2.3s"></animate>
                    <animate attributeName="cy" keyTimes="0;0.5;1" values="32;68;32" dur="2s" repeatCount="indefinite"
                             begin="-1.8s" keySplines="0.5 0 0.5 1;0.5 0 0.5 1" calcMode="spline"></animate>
                    <animate attributeName="fill" keyTimes="0;0.5;1" values="#9eccef;#62d1e7;#9eccef" dur="2s"
                             repeatCount="indefinite" begin="-1.3s"></animate>
                </circle>
                <circle cx="54.838709677419345" cy="50" r="3" fill="#d8b2d8">
                    <animate attributeName="r" times="0;0.5;1"
                             values="2.4000000000000004;3.5999999999999996;2.4000000000000004" dur="2s"
                             repeatCount="indefinite" begin="-1.5s"></animate>
                    <animate attributeName="cy" keyTimes="0;0.5;1" values="32;68;32" dur="2s" repeatCount="indefinite"
                             begin="-1s" keySplines="0.5 0 0.5 1;0.5 0 0.5 1" calcMode="spline"></animate>
                    <animate attributeName="fill" keyTimes="0;0.5;1" values="#d8b2d8;#dcc2e2;#d8b2d8" dur="2s"
                             repeatCount="indefinite" begin="-1.5s"></animate>
                </circle>
                <circle cx="54.838709677419345" cy="50" r="3" fill="#9eccef">
                    <animate attributeName="r" times="0;0.5;1"
                             values="2.4000000000000004;3.5999999999999996;2.4000000000000004" dur="2s"
                             repeatCount="indefinite" begin="-2.5s"></animate>
                    <animate attributeName="cy" keyTimes="0;0.5;1" values="32;68;32" dur="2s" repeatCount="indefinite"
                             begin="-2s" keySplines="0.5 0 0.5 1;0.5 0 0.5 1" calcMode="spline"></animate>
                    <animate attributeName="fill" keyTimes="0;0.5;1" values="#9eccef;#62d1e7;#9eccef" dur="2s"
                             repeatCount="indefinite" begin="-1.5s"></animate>
                </circle>
                <circle cx="64.51612903225805" cy="50" r="3" fill="#d8b2d8">
                    <animate attributeName="r" times="0;0.5;1"
                             values="2.4000000000000004;3.5999999999999996;2.4000000000000004" dur="2s"
                             repeatCount="indefinite" begin="-1.7s"></animate>
                    <animate attributeName="cy" keyTimes="0;0.5;1" values="32;68;32" dur="2s" repeatCount="indefinite"
                             begin="-1.2s" keySplines="0.5 0 0.5 1;0.5 0 0.5 1" calcMode="spline"></animate>
                    <animate attributeName="fill" keyTimes="0;0.5;1" values="#d8b2d8;#dcc2e2;#d8b2d8" dur="2s"
                             repeatCount="indefinite" begin="-1.7s"></animate>
                </circle>
                <circle cx="64.51612903225805" cy="50" r="3" fill="#9eccef">
                    <animate attributeName="r" times="0;0.5;1"
                             values="2.4000000000000004;3.5999999999999996;2.4000000000000004" dur="2s"
                             repeatCount="indefinite" begin="-2.7s"></animate>
                    <animate attributeName="cy" keyTimes="0;0.5;1" values="32;68;32" dur="2s" repeatCount="indefinite"
                             begin="-2.2s" keySplines="0.5 0 0.5 1;0.5 0 0.5 1" calcMode="spline"></animate>
                    <animate attributeName="fill" keyTimes="0;0.5;1" values="#9eccef;#62d1e7;#9eccef" dur="2s"
                             repeatCount="indefinite" begin="-1.7s"></animate>
                </circle>
                <circle cx="74.19354838709677" cy="50" r="3" fill="#d8b2d8">
                    <animate attributeName="r" times="0;0.5;1"
                             values="2.4000000000000004;3.5999999999999996;2.4000000000000004" dur="2s"
                             repeatCount="indefinite" begin="-1.9s"></animate>
                    <animate attributeName="cy" keyTimes="0;0.5;1" values="32;68;32" dur="2s" repeatCount="indefinite"
                             begin="-1.4s" keySplines="0.5 0 0.5 1;0.5 0 0.5 1" calcMode="spline"></animate>
                    <animate attributeName="fill" keyTimes="0;0.5;1" values="#d8b2d8;#dcc2e2;#d8b2d8" dur="2s"
                             repeatCount="indefinite" begin="-1.9s"></animate>
                </circle>
                <circle cx="74.19354838709677" cy="50" r="3" fill="#9eccef">
                    <animate attributeName="r" times="0;0.5;1"
                             values="2.4000000000000004;3.5999999999999996;2.4000000000000004" dur="2s"
                             repeatCount="indefinite" begin="-2.9s"></animate>
                    <animate attributeName="cy" keyTimes="0;0.5;1" values="32;68;32" dur="2s" repeatCount="indefinite"
                             begin="-2.4s" keySplines="0.5 0 0.5 1;0.5 0 0.5 1" calcMode="spline"></animate>
                    <animate attributeName="fill" keyTimes="0;0.5;1" values="#9eccef;#62d1e7;#9eccef" dur="2s"
                             repeatCount="indefinite" begin="-1.9s"></animate>
                </circle>
                <circle cx="83.87096774193547" cy="50" r="3" fill="#d8b2d8">
                    <animate attributeName="r" times="0;0.5;1"
                             values="2.4000000000000004;3.5999999999999996;2.4000000000000004" dur="2s"
                             repeatCount="indefinite" begin="-2.1s"></animate>
                    <animate attributeName="cy" keyTimes="0;0.5;1" values="32;68;32" dur="2s" repeatCount="indefinite"
                             begin="-1.6s" keySplines="0.5 0 0.5 1;0.5 0 0.5 1" calcMode="spline"></animate>
                    <animate attributeName="fill" keyTimes="0;0.5;1" values="#d8b2d8;#dcc2e2;#d8b2d8" dur="2s"
                             repeatCount="indefinite" begin="-2.1s"></animate>
                </circle>
                <circle cx="83.87096774193547" cy="50" r="3" fill="#9eccef">
                    <animate attributeName="r" times="0;0.5;1"
                             values="2.4000000000000004;3.5999999999999996;2.4000000000000004" dur="2s"
                             repeatCount="indefinite" begin="-3.1s"></animate>
                    <animate attributeName="cy" keyTimes="0;0.5;1" values="32;68;32" dur="2s" repeatCount="indefinite"
                             begin="-2.6s" keySplines="0.5 0 0.5 1;0.5 0 0.5 1" calcMode="spline"></animate>
                    <animate attributeName="fill" keyTimes="0;0.5;1" values="#9eccef;#62d1e7;#9eccef" dur="2s"
                             repeatCount="indefinite" begin="-2.1s"></animate>
                </circle>
                <circle cx="93.54838709677418" cy="50" r="3" fill="#d8b2d8">
                    <animate attributeName="r" times="0;0.5;1"
                             values="2.4000000000000004;3.5999999999999996;2.4000000000000004" dur="2s"
                             repeatCount="indefinite" begin="-2.3s"></animate>
                    <animate attributeName="cy" keyTimes="0;0.5;1" values="32;68;32" dur="2s" repeatCount="indefinite"
                             begin="-1.8s" keySplines="0.5 0 0.5 1;0.5 0 0.5 1" calcMode="spline"></animate>
                    <animate attributeName="fill" keyTimes="0;0.5;1" values="#d8b2d8;#dcc2e2;#d8b2d8" dur="2s"
                             repeatCount="indefinite" begin="-2.3s"></animate>
                </circle>
                <circle cx="93.54838709677418" cy="50" r="3" fill="#9eccef">
                    <animate attributeName="r" times="0;0.5;1"
                             values="2.4000000000000004;3.5999999999999996;2.4000000000000004" dur="2s"
                             repeatCount="indefinite" begin="-3.3s"></animate>
                    <animate attributeName="cy" keyTimes="0;0.5;1" values="32;68;32" dur="2s" repeatCount="indefinite"
                             begin="-2.8s" keySplines="0.5 0 0.5 1;0.5 0 0.5 1" calcMode="spline"></animate>
                    <animate attributeName="fill" keyTimes="0;0.5;1" values="#9eccef;#62d1e7;#9eccef" dur="2s"
                             repeatCount="indefinite" begin="-2.3s"></animate>
                </circle>
            </svg>
        </div>
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
                        <input class="field field--date datas edate" id="documentGivedDate"
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


        ///// validateData

                function validateData() {
                    var errors = '';
                    var d = new Date();
                    var month = d.getMonth() + 1;
                    var day = d.getDate() + 1;
                    var nowDate = d.getFullYear() +
                        (month < 10 ? '0' : '')
                        + month +
                        (day < 10 ? '0' : '') + day;
                    var splitted = $("#agrBeg").val().split('.');
                    var agrDate = splitted[2] + splitted[1] + splitted[0];

                    var regEx = /^([0-9]{2})\.([0-9]{2})\.([0-9]{4})$/;
                    var maxDate = new Date();
                    maxDate.setDate(maxDate.getDate() + 90);
                    var maxMonth = maxDate.getMonth() + 1;
                    var maxDay = maxDate.getDate() + 1;
                    var futureDate = maxDate.getFullYear() +
                        (maxMonth < 10 ? '0' : '')
                        + maxMonth +
                        (maxDay < 10 ? '0' : '') + maxDay;
                    var beg = $("#agrBeg").val();
                    var begSplit = beg.split('.');
                    var begDate = begSplit[2] + begSplit[1] + begSplit[0];

                    var end = $("#agrEnd").val();
                    var endSplit = end.split('.');
                    var endDate = endSplit[2] + endSplit[1] + endSplit[0];

                    if ($("#agrBeg").val() == '' || !regEx.test($("#agrBeg").val())
                        || agrDate < nowDate || $('.agentSection').data('type')
                        !== 'renew' && agrDate > futureDate || endDate - begDate < 5) {
                        errors += '<u>Не указана:</u> Дата начала договора<br/>';
                        $("html, body").animate({
                            scrollTop: $("#forAgrBeg").offset().top
                        }, 2000);
                    }

                    if ($("#agrEnd").val() == '' || !regEx.test($("#agrEnd").val())) {
                        errors += '<u>Не указана:</u> Дата окончания договора<br/>';
                        $("html, body").animate({
                            scrollTop: $("#forAgrBeg").offset().top
                        }, 2000);
                    }
                }




                $(function (){

                    $("#agrBeg").datepicker({
                        minDate: new Date(),
                        clearButton: true,


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



