@extends('layouts.general')

@section('content')

    <section class="hero" style="background-image: url({{ asset('images/ochp.jpg')}}); position: relative;">
        <div class="hero__content">
            <h1 class="hero__title"></h1>
            <div class="hero__maintext hero__maintext--bigger">
                <p></p>
            </div>
            <div class="hero__helptext">
                <p></p>
            </div>
            <div class="carousel__tabs" style="bottom: 0px; position: absolute;">
                <nav class="nav nav--tabs nav--hero nav--carousel" id="hidemenu">
                    <ul class="nav__list product_list" data-tabs="">
                        <li><a href="{{ route('product')}}" data-link="hcp_page"
                               class="link nav__item nav__item--tab ">{{ __('navbar.mf15')}}</a></li>
                        <li><a href="{{ route('annuitet') }}" data-link="ann_page"
                               class="link nav__item nav__item--tab">{{ __('navbar.mf16')}}</a></li>
                        <li><a href="{{ route('live') }}" data-link="live_page"
                               class="link nav__item nav__item--tab live ">{{ __('navbar.mf17')}}</a></li>
                        <li><a href="{{ route('retirementinsurance') }}" data-link="live_page"
                               class="link nav__item nav__item--tab">{{ __('navbar.mf18')}}</a></li>
                        <li><a href="{{ route('covid') }}" data-link="live_page"
                               class="link nav__item nav__item--tab active">{{ __('navbar.mf26')}}</a></li>
                        @if(session()->has('authenticated'))
                        <li><a href="{{route('forte-logout')}}" data-link="live_page"
                               class="link nav__item nav__item--tab active">Выход</a></li>
                        @endif
                    </ul>
                </nav>
            </div>
        </div>
    </section>
    <br>

    <!-- form ksj covid -->

    <div class="calculator__block bg-grey entry agentBlock agentHasError" id="section1">
        @include('mini_parts.overloader')
        <h3 class="calculator__title col--12-12 p-3">Ненакопительное (срочное) страхование жизни на случай заболевания COVID-19</h3>
        <h3 class="calculator__title col--12-12 p-3">
            Личные данные</h3>
        @csrf
        <div class="grid">
            <div id="ajax"></div>

            <!-- ИИН -->

            <div class="col--12-12">
                <fieldset class="field-set col col--6-12">
                    <label for="orderIIN" class="field-set__label checkList">
                        ИИН
                    </label>
                    <input class="field field datas iin" id="iin"
                           type="" name="iin" value="{{$dataUrl['subjects'][0]['user']['iin'] ?? ''}}"
                           maxlength="12" onkeyup="showOrHideBlock('iin_error','iin')">
                    <strong><small id="iin_error" class="form-text text-" style="display: none; color: crimson">
                           Поле иин не заполнено</small></strong>
                </fieldset>
            </div>
        </div>

        <div class="grid">

            <!-- Имя -->

            <fieldset class="field-set col col--3-12">
                <label for="orderfirstName" class="field-set__label checkList">Имя </label>
                <input class="field datas keyboardInput agentData1 input-check clearFields" onchange="showBlock1()" onkeypress="showBlock1()" type="text" name="firstName"
                       id="firstName"
                       onkeyup="showOrHideBlock('firstName_error','firstName')"
                       value="{{$dataUrl['subjects'][0]['user']['first_name'] ?? ''}}">
                <strong><small id="firstName_error" class="form-text text-" style="display: none; color: crimson">
                        Поле имя не заполнено</small></strong>
            </fieldset>

            <!-- Фамилия -->

            <fieldset class="field-set col col--3-12 ">
                <label for="orderlastName" class="field-set__label checkList">Фамилия </label>
                <input class="field datas keyboardInput agentData1 input-check clearFields" type="text"
                       name="lastName" id="lastName" value="{{$dataUrl['subjects'][0]['user']['last_name'] ?? ''}}"
                       onkeyup="showOrHideBlock('lastName_error','lastName')">
                <strong><small id="lastName_error" class="form-text text-" style="display: none; color: crimson">
                        Поле фамилия не заполнено</small></strong>
            </fieldset>

            <!-- Отчество -->

            <fieldset class="field-set col col--3-12">
                <label for="patronymicName" class="field-set__label checkList">Отчество</label>
                <input class="field datas keyboardInput agentData1 input-check clearFields"  type="text"
                       name="patronymicName" id="patronymicName"
                       onkeyup="showOrHideBlock('patronymicName_error','patronymicName')"
                       value="{{$dataUrl['subjects'][0]['user']['patronymic_name'] ?? ''}}">
                <strong><small id="patronymicName_error" class="form-text text-"
                               style="display: none; color: crimson">
                        Поле отчество не заполнено</small></strong>
            </fieldset>

            <!-- Дата рождения -->

            <fieldset class="field-set col col--3-12">
                <label for="orderDocDate" class="field-set__label checkList">Дата рождения </label>
                <input class="field field--date datas edate input-check clearFields" onchange="showBlock1()" onkeypress="showBlock1()" id="born" type="tel"
                       name="born" maxlength="10" placeholder="dd.mm.yyyy"
                       onkeyup="showOrHideBlock('born_error','born')"
                       value="{{$dataUrl['subjects'][0]['user']['born'] ?? ''}}" autocomplete="off">
                <strong><small id="born_error" class="form-text text-" style="display: none; color: crimson">
                        Поле дата рождения не заполнено</small></strong>
            </fieldset>
        </div>

        <div class="grid">
            <!-- Тип документа -->
            <fieldset class="field-set col col--3-12" id="fieldDocType1">
                <div id="doctypeField">
                    <label for="orderBenefit" class="field-set__label checkList">Тип документа </label>
                    <select name="documentTypeId" id="documentTypeId" tabindex="-1"
                            class="benefits datas agentData1 field input-check clearFields" onchange="showBlock1()" onkeypress="showBlock1()"  onkeyup="showOrHideBlock('documentTypeId_error','documentTypeId')">
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
                    <strong><small id="documentTypeId_error" class="form-text text-"
                                   style="display: none; color: crimson">
                            Вы не выбрали тип документа</small></strong>
                </div>
            </fieldset>

            <!-- Номер документа -->

            <fieldset class="field-set col col--3-12">
                <label for="orderDocNumber" class="field-set__label checkList">
                    Номер документа </label>
                <input class="field field-- datas input-check clearFields" onchange="showBlock1()" onkeypress="showBlock1()" id="documentNumber" type="text" name="documentNumber"
                       onkeyup="showOrHideBlock('documentNumber_error','documentNumber')"
                       value="{{$dataUrl['subjects'][0]['user']['document_number'] ?? ''}}">
                <strong><small id="documentNumber_error" class="form-text text-"
                               style="display: none; color: crimson">
                        Поле номер документа не заполнено</small></strong>
            </fieldset>

            <!-- Дата выдачи документа -->

            <fieldset class="field-set col col--3-12">
                <label for="documentGivedDate" class="field-set__label checkList">Дата выдачи документа </label>
                <input class="field field--date datas edate input-check clearFields" onchange="showBlock1()" onkeypress="showBlock1()" id="documentGivedDate"
                       name="documentGivedDate" maxlength="10" placeholder="dd.mm.yyyy"
                       onkeyup="showOrHideBlock('documentGivedDate_error','documentGivedDate')"
                       value="{{$dataUrl['subjects'][0]['user']['document_gived_date'] ?? ''}}" autocomplete="off">
                <strong><small id="documentGivedDate_error" class="form-text text-"
                               style="display: none; color: crimson">
                        Поле когда выдан не заполнено</small></strong>
            </fieldset>

            <!-- Кем выдан -->

            <fieldset class="field-set col col--3-12">
                <label for="orderdocumentGivedBy" class="field-set__label checkList">Кем выдан </label>
                <input class="field datas keyboardInput agentData1 input-check clearFields"  onchange="showBlock1()" onkeypress="showBlock1()"id="documentGivedBy" type="text"
                       name="documentGivedBy" maxlength="10"
                       onkeyup="showOrHideBlock('documentGivedBy_error','documentGivedBy')"
                       value="{{$dataUrl['subjects'][0]['user']['document_gived_by'] ?? ''}}" autocomplete="off">
                <strong><small id="documentGivedBy_error" class="form-text text-"
                               style="display: none; color: crimson">
                       Поле кем выдан не заполнено</small></strong>
            </fieldset>
        </div>

        <div class="grid">

            <!-- Застрахованный является Страхователем -->

            <fieldset class="field-set col col--4-12">
                <label class="field-set__label"></label>
                <label class="checkbox wrongCheckBox" id="insuredInsurerChBox">
                    <input type="checkbox" name="insuredInsurer" id="insuredInsurer" value="yes"
                           class="checkbox-cov"
                           checked="checked" disabled>
                    <span class="checkbox__label">Застрахованный является Страхователем</span>
                </label>
            </fieldset>

            <!-- НЕ является  резидентом США -->

            <fieldset class="field-set col col--6-12">
                <label class="field-set__label"></label>
                <label class="checkbox wrongCheckBox" id="notResidentUsaChBox">
                    <input type="checkbox" name="notResidentUSA" id="notResidentUSA"  value="no" class="checkbox-cov"
                           checked="checked" disabled>
                    <span
                        class="checkbox__label">Застрахованный  НЕ является  резидентом США/гражданином США</span>
                </label>
            </fieldset>
            <p class="p-3" style="margin-top: -25px;">«Выгодоприобретателем (-ями) (лицом, назначенным для получения
                страховой выплаты по страховому случаю &quot;смерть Застрахованного&quot;) является (-ются) наследник
                (-и) по Закону РК.».</p>
        </div>


        <div class="grid" id="block1" style="display: {{$dataUrl['subjects'][0]['user']['iin'] ?? 'none'}}">

            <!-- Программа -->

            <fieldset class="field-set col col--6-12">
                <div id="programField">
                <label for="orderBenefit" class="field-set__label">Программа</label>
                <select name="programISN" id="programISN" tabindex="-1" onchange="showBlock2()"
                        class="benefits datas agentData1 field input-check programIsn"  onkeyup="showOrHideBlock('programISN_error','programISN')">
                    <option value="0" >--</option>
                    <option value="898641" {{ 898641 == ($dataUrl['programISN'] ?? '') ? 'selected' : ''}}>Программа
                        1
                    </option>
                    <option value="898651" {{ 898651 == ($dataUrl['programISN'] ?? '') ? 'selected' : ''}}>Программа
                        2
                    </option>
                    <option value="898661" {{ 898661 == ($dataUrl['programISN'] ?? '') ? 'selected' : ''}}>Программа
                        3
                    </option>
                </select>
                <strong><small id="programISN_error" class="form-text text-"
                               style="display: none; color: crimson">
                        Вы не выбрали программу</small></strong>
                    <p id="programLink"><a href="{{ route('program-covid')}}" target="_blank">«Ознакомиться с полными условиями».</a></p>
                    <p id="programLink1" style="display: none"><a href="{{ route('program-covid',[ 'id' =>'1'])}}" target="_blank">«Ознакомиться с полными условиями по программе 1».</a></p>
                    <p id="programLink2" style="display: none"><a href="{{ route('program-covid',[ 'id' =>'2'])}}" target="_blank">«Ознакомиться с полными условиями по программе 2».</a></p>
                    <p id="programLink3" style="display: none"><a href="{{ route('program-covid',[ 'id' =>'3'])}}" target="_blank">«Ознакомиться с полными условиями по программе 3».</a></p>
                </div>
            </fieldset>

            <!--    Страховая сумма -->

            <fieldset class="field-set col col--6-12">
                <label for="orderEmail" class="field-set__label checkList">
                    Страховая сумма</label>
                <input type="text" class="field datas keyboardInput agentData1 input-check" id="limitSum"
                       name="limitSum" disabled
                       value="{{$dataUrl['limitSum'] ?? ''}}">
            </fieldset>

            <!-- table programm 1 -->

            <table class="table table-bordered covid-program" style="display: none" id="program1">
                <tbody>
                <tr>
                    <th colspan="">Период страхования</th>
                    <td style="border: none;"><span style="font-weight: bold"> 12 месяцев</span></td>
                </tr>

                <tr>
                    <th>Условия</th>
                    <th>Программа 1</th>
                </tr>
                <tr>
                    <th>Общая страховая сумма</th>
                    <td>1 000 000</td>
                </tr>
                <tr>
                    <th>Госпитализация</th>
                    <td>100 000</td>
                </tr>
                <tr>
                    <th>Смерть</th>
                    <td>900 000</td>
                </tr>
                <tr>
                    <th>Страховая премия</th>
                    <td>9 900</td>
                </tr>
                <tr>
                    <th>Годовой тариф</th>
                    <td>0,99%</td>
                </tr>
                </tbody>
            </table>

            <!-- table programm 2 -->

            <table class="table table-bordered covid-program" style="display: none" id="program2">
                <tbody>
                <tr>
                    <th>Период страхования</th>
                    <td style="border: none;"><span style="font-weight: bold"> 12 месяцев</span></td>
                </tr>
                <tr>
                    <th>Условия</th>
                    <th>Программа 2</th>
                </tr>
                <tr>
                    <th>Общая страховая сумма</th>
                    <td>2 000 000</td>
                </tr>
                <tr>
                    <th>Госпитализация</th>
                    <td>200 000</td>
                </tr>
                <tr>
                    <th>Смерть</th>
                    <td>1 800 000</td>
                </tr>
                <tr>
                    <th>Страховая премия</th>
                    <td>18 000</td>
                </tr>
                <tr>
                    <th>Годовой тариф</th>
                    <td>0,90%</td>
                </tr>
                </tbody>
            </table>

            <!-- table programm 3 -->

            <table class="table table-bordered covid-program" style="display: none" id="program3">
                <tbody>
                <tr>
                    <th>Период страхования</th>
                    <td style="border: none;"><span style="font-weight: bold"> 12 месяцев</span></td>
                </tr>
                <tr>
                    <th>Условия</th>
                    <th>Программа 3</th>
                </tr>
                <tr>
                    <th>Общая страховая сумма</th>
                    <td>3 000 000</td>
                </tr>
                <tr>
                    <th>Госпитализация</th>
                    <td>300 000</td>
                </tr>
                <tr>
                    <th>Смерть</th>
                    <td>2 700 000</td>
                </tr>
                <tr>
                    <th>Страховая премия</th>
                    <td>26 100</td>
                </tr>
                <tr>
                    <th>Годовой тариф</th>

                    <td>0,87%</td>
                </tr>
                </tbody>
            </table>

            <!-- Дата начала договора -->

            <fieldset class="field-set col col--6-12">
                <div id="forAgrBeg">
                    <h3 class="col--12-12">Дата начала договора</h3>
                    <input class="field field--date edate dateBeg col--6-12 input-check dateBegChange" id="dateBeg" type="text"
                           name="dateBeg"
                           maxlength="10" placeholder="dd.mm.yyyy" onchange="showBlock2()" onkeypress="showBlock2()"
                           onkeyup="showOrHideBlock('dateBeg_error','dateBeg')"
                           value="{{$dataUrl['dateBeg'] ?? ''}}" autocomplete="off">
                    <strong><small id="dateBeg_error" class="form-text text- dateBeg"
                                   style="display: none; color: crimson">
                            Вы не указали дату</small></strong>
                    <p>«Договор страхования начинает действовать по истечении 7 (семи)
                        календарных дней с даты заключения договора страхования.»</p>
                </div>
            </fieldset>


            <!-- Дата окончания договора -->

            <fieldset class="field-set col col--6-12">
                <h3 class="col--12-12">Дата окончания договора</h3>
                <input class="field col--6-12 edate dateEnd field--date input-check dateBegChange" id="dateEnd" type="text"
                       name="dateEnd"
                       maxlength="10" value="{{$dataUrl['dateEnd'] ?? ''}}" placeholder="dd.mm.yyyy"
                       autocomplete="off" disabled="">
            </fieldset>
        </div>

        <div class="grid" id="block2" style="display:{{$dataUrl['subjects'][0]['user']['iin'] ?? 'none'}}">

            <fieldset class="field-set col col--full">
                <label for="orderBenefit" class="field-set__label">
                    Способ уведомления</label><select
                    name="notificationISN" id="notificationISN" tabindex="-1"
                    class="benefits datas agentData1 field input-check sms" onchange="showBlock3()"
                    onkeyup="showOrHideBlock('notificationISN_error','notificationISN')" >
                    <option value="898821" {{ 898821 == ($dataUrl['notificationISN'] ?? '') ? 'selected' : ''}}>
                        Email от Сентрас Коммеск Life + SMS от ЕСБД
                    </option>
                    <option value="898811" {{ 898811 == ($dataUrl['notificationISN'] ?? '') ? 'selected' : ''}}>
                        Email от Сентрас Коммеск Life + Email от ЕСБД
                    </option>
                    <option value="898831" {{ 898831 == ($dataUrl['notificationISN'] ?? '') ? 'selected' : ''}}>SMS
                        от ЕСБД
                    </option>
                    <option value="898841" {{ 898841 == ($dataUrl['notificationISN'] ?? '') ? 'selected' : ''}}>SMS
                        от Сентрас Коммеск Life + Email от ЕСБД
                    </option>
                    <option value="898851" {{ 898851 == ($dataUrl['notificationISN'] ?? '') ? 'selected' : ''}}>SMS
                        от Сентрас Коммеск Life + SMS от ЕСБД
                    </option>
                </select>
                <strong><small id="notificationISN_error" class="form-text text-" style="display: none; color: crimson">
                        Вы не выбрали способ уведомления</small></strong>
                <p>«Просим указать куда направлять информацию о заключении договора страхования»</p>
            </fieldset>

            <!-- Мобильный номер -->

            <fieldset class="field-set col col--6-12" id="phone-field">
                <label for="orderPhone" class="field-set__label checkList">
                    Мобильный телефон </label>
                <input type="tel" class="field interTel datas phone_number input-check" id="phone"
                       name="phone"
                       onkeyup="showOrHideBlock('phone_error','phone')" onchange="showBlock3()"
                       onkeypress="showBlock3() "
                       value="{{$dataUrl['phone'] ?? ''}}">
                <strong><small id="phone_error" class="form-text text-" style="display: none; color: crimson">
                     Поле телефон не заполнено</small></strong>
            </fieldset>

            <!-- E-Mail -->

            <fieldset class="field-set col col--6-12 email-field" style="display:@if(($dataUrl['email'] ?? '') == '' && ($dataUrl['phone'] ?? '' < 0)) none  @else block  @endif;" >

                <label for="orderEmail" class="field-set__label checkList">
                    E-Mail </label>
                <input type="text" class="field datas keyboardInput agentData1 input-check" id="email" name="email"
                       onkeyup="showOrHideBlock('email_error','email')"  onchange="showBlock3()" onkeypress="showBlock3()"
                       value="{{$dataUrl['email'] ?? ''}}">
                <strong><small id="email_error" class="form-text"
                               style="display: none; color: crimson"></small></strong>
            </fieldset>

        </div>
    </div>

    @if(session()->has('authenticated'))

        <!-- Если пользователь форте, анкету не показываем, сразу показываем кнопку рассчета -->

    @else
        <!-- Анкета -->  <!-- Анкета -->  <!-- Анкета -->

    <div class="calculator__section calculator__section--special badkasko" id="block3" style="display:{{$dataUrl['subjects'][0]['user']['iin'] ?? 'none'}}">
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
									<input type="checkbox" class="checkbox-cov input-check" name="hasInvalid" value=""
                                           id="hasInvalid">
                                        <span class="checkbox__label">Застрахованный имеет инвалидность.</span>
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
                                           class="checkbox-cov input-check">
                                    <span class="checkbox__label">Застрахованный стоит на учете в психоневрологическом диспансере.</span>
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
                                           class="checkbox-cov input-check">
                                    <span class="checkbox__label">Застрахованному диагностировались онкологические заболевания</span>
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
                    <input type="checkbox" name="hasChronic" value="" id="hasChronic" class="checkbox-cov input-check">
                    <span
                        class="checkbox__label">Застрахованному проводились консультации/медицинское обследование/лечение по СПИД,
ВИЧ.</span>
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
                     <input type="checkbox" name="hasCriminal" value="" id="hasCriminal" class="checkbox-cov input-check">
                    <span class="checkbox__label">
                    Застрахованный является лицом, отбывающим наказание за совершение уголовных
преступлений в учреждениях уголовно-исполнительной системы.
              </span>
               </label></h5>
                                </span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @endif

    <div class="calculator__section" id="calculateSum"
         style="display:{{$dataUrl['subjects'][0]['user']['iin'] ?? 'none'}}">
        <div class="calculator__block bg-grey">
            <div class="grid">
                <div class="col col--6-12">
                    <button onclick="" id="sendOrder"
                            class="button button--prime">
                        Рассчитать
                    </button>
                    <div class="" style="display: @if(($premiumSum ?? '') > 0) block @else none @endif; font-weight: bold; margin-top: 13px;"
                        id="premiumWrapper">
                        Итого: <span id="premium" class="premium"
                                     style="font-size: larger;">@if(($premiumSum ?? '') > 0) {{ number_format($premiumSum ?? '', 0, ',', ' ')}} @endif</span> тг
                    </div>
                </div>

                @if(session()->has('authenticated'))
                    <div  id="sendLinkShow" class="col col--6-12" style="display:none;">
                        <button onclick="" id="sendLink"
                                class="button button--prime">
                         Отправить ссылку
                        </button>
                    </div>
                @else
                <div  id="nextStepShow" class="col col--6-12" style="display:none;">
                    <button onclick="" id="nextStep"
                            class="button button--prime">
                        Следующий шаг
                    </button>
                </div>
                @endif
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
                <input type="text" name="hash" id="hash"
                       value="" style="display: none">
                <input type="text" name="hash" id="hash"
                       value="" style="display: none">
                <input type="text" name="hash" id="hash"
                       value="" style="display: none">
                <input type="text" name="hash" id="hash"
                       value="" style="display: none">
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


    <!-- Начало Скрипта -->

    @include('mini_parts.covid_scripts')

    <!-- Button trigger modal -->

    @include('mini_parts.covid_modal')

    </main>

@endsection
