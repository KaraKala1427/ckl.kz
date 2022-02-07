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
                        <li><a href="/logout" data-link="live_page"
                               class="link nav__item nav__item--tab active">Выйти</a></li>
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
                            Вы не указали ваш иин</small></strong>
                </fieldset>
            </div>
        </div>

        <div class="grid">

            <!-- Имя -->

            <fieldset class="field-set col col--3-12">
                <label for="orderfirstName" class="field-set__label checkList">Имя </label>
                <input class="field datas keyboardInput agentData1 input-check clearFields" type="text" name="firstName"
                       id="firstName"
                       onkeyup="showOrHideBlock('firstName_error','firstName')"
                       value="{{$dataUrl['subjects'][0]['user']['first_name'] ?? ''}}">
                <strong><small id="firstName_error" class="form-text text-" style="display: none; color: crimson">
                        Вы не указали ваше имя</small></strong>
            </fieldset>

            <!-- Фамилия -->

            <fieldset class="field-set col col--3-12 ">
                <label for="orderlastName" class="field-set__label checkList">Фамилия </label>
                <input class="field datas keyboardInput agentData1 input-check clearFields" type="text"
                       name="lastName" id="lastName" value="{{$dataUrl['subjects'][0]['user']['last_name'] ?? ''}}"
                       onkeyup="showOrHideBlock('lastName_error','lastName')">
                <strong><small id="lastName_error" class="form-text text-" style="display: none; color: crimson">
                        Вы не указали вашу фамилию</small></strong>
            </fieldset>

            <!-- Отчество -->

            <fieldset class="field-set col col--3-12">
                <label for="patronymicName" class="field-set__label checkList">Отчество</label>
                <input class="field datas keyboardInput agentData1 input-check clearFields" type="text"
                       name="patronymicName" id="patronymicName"
                       onkeyup="showOrHideBlock('patronymicName_error','patronymicName')"
                       value="{{$dataUrl['subjects'][0]['user']['patronymic_name'] ?? ''}}">
                <strong><small id="patronymicName_error" class="form-text text-"
                               style="display: none; color: crimson">
                        Вы не указали ваше отчество</small></strong>
            </fieldset>

            <!-- Дата рождения -->

            <fieldset class="field-set col col--3-12">
                <label for="orderDocDate" class="field-set__label checkList">Дата рождения </label>
                <input class="field field--date datas edate input-check clearFields" id="born" type="tel"
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
                            class="benefits datas agentData1 field input-check clearFields"  onkeyup="showOrHideBlock('documentTypeId_error','documentTypeId')">
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
                <input class="field field-- datas input-check clearFields" id="documentNumber" type="text" name="documentNumber"
                       onkeyup="showOrHideBlock('documentNumber_error','documentNumber')"
                       value="{{$dataUrl['subjects'][0]['user']['document_number'] ?? ''}}">
                <strong><small id="documentNumber_error" class="form-text text-"
                               style="display: none; color: crimson">
                        Вы не указали номер документа</small></strong>
            </fieldset>

            <!-- Дата выдачи документа -->

            <fieldset class="field-set col col--3-12">
                <label for="documentGivedDate" class="field-set__label checkList">Дата выдачи документа </label>
                <input class="field field--date datas edate input-check clearFields" id="documentGivedDate"
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
                <input class="field datas keyboardInput agentData1 input-check clearFields" id="documentGivedBy" type="text"
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
                        Вы не указали телефон</small></strong>
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
                         Отравить ссылку
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

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://unpkg.com/imask"></script>
    <script type="text/javascript">


        // возврат оишбок в формате json через модальное окно

        function showError(text) {
            $('#modalText').html(text);
            $('#modalError').modal('show');
        }

        // функция для скрытия ошибок после заполения поля

        function showOrHideBlock(errorBlock, manipulationBlock) {
            $('#' + errorBlock).hide();
        }

        //


        $(document).ready(function () {
            $('.input-check').on("change keypress", function () {

                $("#nextStepShow").hide();
                $("#sendLinkShow").hide();

                $("#sendOrder").prop("disabled", false);


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
                    $("#email_error").html(" Вы не указали email").show();
                    return false;
                }
                var regex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
                if (!regex.test(email)) {
                    $("#email_error").html("Неверный формат почты").show();
                    return false;
                } else {
                    return true;
                }
            }

            // Валидация номера

            function isPhone(phone) {
                if ((phone) == '') {
                    $("#phone_error").html("Вы не указали телефон").show();
                    return false;
                }
                if (phone.length < 11) {
                    $("#phone_error").html("Неправильно введен номер").show();
                    return false;
                } else {
                    return true;
                }
            }

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
                            showError("Неизвестная ошибка");
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
                                window.location.href = url;
                            }
                        },
                        failure: function () {
                            showError("Неизвестная ошибка");
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
                            data = data.client;
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
                                showError("ИИН не найден в базе");
                                $("#block1").hide();
                                $("#block2").hide();
                                $("#block3").hide();
                                $("#calculateSum").hide();
                            }
                            else if (data.code === 406){
                                showError("На страхование принимаются лица НЕ старше 65 лет на момент заключения Договора");
                                $("#block1").hide();
                                $("#block2").hide();
                                $("#block3").hide();
                                $("#calculateSum").hide();
                            }
                            else {
                                showError("Ошибка доступа к серверу");
                            }
                            $('#overLoader').hide()
                        }
                    }
                });
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
                $("#dateEnd").val("");
                return false;
            } else if (dateBeg > futureDate) {
                $("#dateBeg_error").show().html("Максимальное количество дней ДО даты начала договора " +
                    "- 90 от текущей даты. Пожалуйста, скорректируйте");
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

    <!-- Button trigger modal -->

    <div class="modal fade" id="modalError" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                </div>
                <div class="modal-body">
                    <p id="modalText" style="color: crimson;"></p>
                </div>
                <div class="modal-footer">
                </div>
            </div>
        </div>
    </div>

    </main>

@endsection
