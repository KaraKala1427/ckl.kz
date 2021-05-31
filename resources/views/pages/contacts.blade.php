@extends('layouts.general')

@section('content')

    <div class="card-body">
        @if($message = Session::get('success'))
            <div class="alert alert-success">
                <strong>{{$message}}</strong>
            </div>
        @endif
    </div>

            <main class="main">
                <div class="container">
                    <div class="contacts">
                        <section class=" content">

                            <h3 class="contacts__title content__title">Контакты в
                                <div class="contacts__dropdown dropdown dropdown--light">
                                    <div class="dropdown__toggle button button--hollow ctcg citiest city_contact  ">
                                        Алматы
                                    </div>

                                    <div class="dropdown__menu cityger_contact">
                                        <ul class="dropdown__list myid" >
                                            <li><a georegion="almaty" georegionkk="	" georegionru="Алматы"
                                                   value=Алматы tel="+7 727 244 74 00" id="almaty" data-current="1">Алматы</a>
                                            <li><a georegion="aktau" georegionkk="	" georegionru="Актау"
                                                   value=Актау tel="+7 727 244 74 00" id="aktau" data-current="0">Актау</a>
                                            <li><a georegion="aktobe" georegionkk="	" georegionru="Актобе"
                                                   value=Актобе tel="+7 727 244 74 00" id="aktobe" data-current="0">Актобе</a>
                                            <li><a georegion="atyrau" georegionkk="	" georegionru="Атырау"
                                                   value=Атырау tel="+7 727 244 74 00" id="atyrau" data-current="0">Атырау</a>
                                            <li><a georegion="karaganda" georegionkk="	" georegionru="Караганда"
                                                   value=Караганда tel="+7 727 244 74 00" id="karaganda"
                                                   data-current="0">Караганда</a>
                                            <li><a georegion="kokshetau" georegionkk="	" georegionru="Кокшетау"
                                                   value=Кокшетау tel="+7 727 244 74 00" id="kokshetau"
                                                   data-current="0">Кокшетау</a>
                                            <li><a georegion="kostanay" georegionkk="	" georegionru="Костанай"
                                                   value=Костанай tel="+7 727 244 74 00" id="kostanay" data-current="0">Костанай</a>
                                            <li><a georegion="kyzylorda" georegionkk="	" georegionru="Кызылорда"
                                                   value=Кызылорда tel="+7 727 244 74 00" id="kyzylorda"
                                                   data-current="0">Кызылорда</a>
                                            <li><a georegion="nur-sultan" georegionkk="	" georegionru="Нур-Султан"
                                                   value=Нур-Султан tel="+7 727 244 74 00" id="nur-sultan"
                                                   data-current="0">Нур-Султан</a>
                                            <li><a georegion="pavlodar" georegionkk="	" georegionru="Павлодар"
                                                   value=Павлодар tel="+7 727 244 74 00" id="pavlodar" data-current="0">Павлодар</a>
                                            <li><a georegion="petropavlovsk" georegionkk="	"
                                                   georegionru="Петропавловск"
                                                   value=Петропавловск tel="+7 727 244 74 00" id="petropavlovsk"
                                                   data-current="0">Петропавловск</a>
                                            <li><a georegion="semey" georegionkk="	" georegionru="Семей"
                                                   value=Семей tel="+7 727 244 74 00" id="semey" data-current="0">Семей</a>
                                            <li><a georegion="taldykorgan" georegionkk="	" georegionru="Талдыкорган"
                                                   value=Талдыкорган tel="+7 727 244 74 00" id="taldykorgan"
                                                   data-current="0">Талдыкорган</a>
                                            <li><a georegion="taraz" georegionkk="	" georegionru="Тараз"
                                                   value=Тараз tel="+7 727 244 74 00" id="taraz" data-current="0">Тараз</a>
                                            <li><a georegion="turkestan" georegionkk="	" georegionru="Туркестан"
                                                   value=Туркестан tel="+7 727 244 74 00" id="turkestan"
                                                   data-current="0">Туркестан</a>
                                            <li><a georegion="ural-sk" georegionkk="	" georegionru="Уральск"
                                                   value=Уральск tel="+7 727 244 74 00" id="ural-sk" data-current="0">Уральск</a>
                                            <li><a georegion="ust--kamenogorsk" georegionkk="	"
                                                   georegionru="Усть-Каменогорск"
                                                   value=Усть-Каменогорск tel="+7 727 244 74 00" id="ust--kamenogorsk"
                                                   data-current="0">Усть-Каменогорск</a>
                                            <li><a georegion="shymkent" georegionkk="	" georegionru="Шымкент"
                                                   value=Шымкент tel="+7 727 244 74 00" id="shymkent" data-current="0">Шымкент</a>
                                        </ul>
                                    </div>
                                    <!-- end dropdown-menu -->
                                </div> <!-- end dropdown -->
                            </h3>

                            <!-- end  contacts__title -->
                            <div class="grid contacts__grid" data-tab-component>
                                <aside class="contacts__nav" onchange="myScript()" >
                                    <nav class="nav nav--arrows js-map-nav" data-tabs>

                                        <div class="nav__select contacts__select " onchange="myScript()">
                                            <div class="contacts__dropdown dropdown dropdown--light">
                                                <div class="dropdown__toggle button button--hollow mobmainof ">Адреса
                                                    офисов продаж
                                                </div>
                                                <div class="dropdown__menu ">
                                                    <ul class="dropdown__list myid">

                                                        <li>Головной офис</li>
                                                        <li class="headofficesm selalmaty"><a ofct="Алматы" id="sshow78"
                                                                                              clickdata="show78"
                                                                                              data-geo="43.263035, 76.934910,*+7 727 244 74 10"
                                                                                              class="headoffm hoalmaty ">Наурызбай
                                                                батыра,19 </a></li>
                                                        <li class="headofficesm selaktau"><a ofct="Актау" id="sshow157"
                                                                                             clickdata="show157"
                                                                                             data-geo="43.647838, 51.153686"
                                                                                             class="headoffm hoaktau ">9-й
                                                                мкр., д. 29</a></li>
                                                        <li class="headofficesm selaktobe"><a ofct="Актобе"
                                                                                              id="sshow108"
                                                                                              clickdata="show108"
                                                                                              data-geo="50.300891, 57.151118,*+7 (7132) 547-587"
                                                                                              class="headoffm hoaktobe ">Пацаева,
                                                                6</a></li>
                                                        <li class="headofficesm selatyrau"><a ofct="Атырау"
                                                                                              id="sshow110"
                                                                                              clickdata="show110"
                                                                                              data-geo="47.095814, 51.925061"
                                                                                              class="headoffm hoatyrau ">М.Өтемісұлы,
                                                                121</a></li>
                                                        <li class="headofficesm selkaraganda"><a ofct="Караганда"
                                                                                                 id="sshow111"
                                                                                                 clickdata="show111"
                                                                                                 data-geo="49.803791, 73.098942"
                                                                                                 class="headoffm hokaraganda ">Н.Абдирова,
                                                                17</a></li>
                                                        <li class="headofficesm selkokshetau"><a ofct="Кокшетау"
                                                                                                 id="sshow112"
                                                                                                 clickdata="show112"
                                                                                                 data-geo="53.289116, 69.399666"
                                                                                                 class="headoffm hokokshetau ">Ауэзова,
                                                                268</a></li>
                                                        <li class="headofficesm selkostanay"><a ofct="Костанай"
                                                                                                id="sshow113"
                                                                                                clickdata="show113"
                                                                                                data-geo="53.230187, 63.616713"
                                                                                                class="headoffm hokostanay ">Темирбаева,
                                                                39</a></li>
                                                        <li class="headofficesm selkyzylorda"><a ofct="Кызылорда"
                                                                                                 id="sshow114"
                                                                                                 clickdata="show114"
                                                                                                 data-geo="44.846935, 65.502324"
                                                                                                 class="headoffm hokyzylorda ">Байтурсынова,
                                                                47</a></li>
                                                        <li class="headofficesm selnur-sultan"><a ofct="Нур-Султан"
                                                                                                  id="sshow105"
                                                                                                  clickdata="show105"
                                                                                                  data-geo="51.1684, 71.4136,*+7 7172 32-85-09"
                                                                                                  class="headoffm honur-sultan ">пр.
                                                                Женис,16</a></li>
                                                        <li class="headofficesm selpavlodar"><a ofct="Павлодар"
                                                                                                id="sshow115"
                                                                                                clickdata="show115"
                                                                                                data-geo="52.283423, 76.972836"
                                                                                                class="headoffm hopavlodar ">Естая,
                                                                89</a></li>
                                                        <li class="headofficesm selpetropavlovsk"><a
                                                                ofct="Петропавловск" id="sshow116" clickdata="show116"
                                                                data-geo="54.861058, 69.163508"
                                                                class="headoffm hopetropavlovsk ">Батыр Баян, 30</a>
                                                        </li>
                                                        <li class="headofficesm selsemey"><a ofct="Семей" id="sshow117"
                                                                                             clickdata="show117"
                                                                                             data-geo="50.415406, 80.254907"
                                                                                             class="headoffm hosemey ">Шакерима,
                                                                54</a></li>
                                                        <li class="headofficesm seltaldykorgan"><a ofct="Талдыкорган"
                                                                                                   id="sshow118"
                                                                                                   clickdata="show118"
                                                                                                   data-geo="45.015806, 78.374161"
                                                                                                   class="headoffm hotaldykorgan ">Шевченко,
                                                                140</a></li>
                                                        <li class="headofficesm seltaraz"><a ofct="Тараз" id="sshow119"
                                                                                             clickdata="show119"
                                                                                             data-geo="42.901570, 71.374741"
                                                                                             class="headoffm hotaraz ">Толе
                                                                би, 38</a></li>
                                                        <li class="headofficesm selturkestan"><a ofct="Туркестан"
                                                                                                 id="sshow109"
                                                                                                 clickdata="show109"
                                                                                                 data-geo="51.823414, 68.360201"
                                                                                                 class="headoffm hoturkestan ">Тауке
                                                                Хан, 246</a></li>
                                                        <li class="headofficesm selural-sk"><a ofct="Уральск"
                                                                                               id="sshow120"
                                                                                               clickdata="show120"
                                                                                               data-geo="51.212613, 51.366348"
                                                                                               class="headoffm houral-sk ">Нурсултана
                                                                Назарбаева, 203</a></li>
                                                        <li class="headofficesm selust--kamenogorsk"><a
                                                                ofct="Усть-Каменогорск" id="sshow121"
                                                                clickdata="show121" data-geo="49.960349, 82.604844"
                                                                class="headoffm houst--kamenogorsk ">пр. Нурсултана
                                                                Назарбаева, 22</a></li>
                                                        <li class="headofficesm selshymkent"><a ofct="Шымкент"
                                                                                                id="sshow84"
                                                                                                clickdata="show84"
                                                                                                data-geo="42.316041, 69.608206"
                                                                                                class="headoffm hoshymkent ">Тауке
                                                                хана, 47</a></li>
                                                        <li>Центры прямых продаж</li>
                                                        <li class="headofficesm selalmaty"><a ofct="Алматы"
                                                                                              id="sshow167"
                                                                                              clickdata="show167"
                                                                                              data-geo="43.239484, 76.908110"
                                                                                              class="headoffm headofficessel ">пр.Абая,
                                                                60</a></li>

                                                    </ul>
                                                </div>
                                                <!-- end dropdown-menu -->
                                            </div>
                                        </div>


                                        <div class="menuwraper disalmaty"><h4 class="nav__title">Головной офис</h4>
                                            <ul class="nav__list">
                                                <li>
                                                    <a ofct="Алматы" id="show78" style="" data-tab
                                                       data-geo="43.263035, 76.934910,*+7 727 244 74 10"
                                                       class="js-map-toggle link nav__item headoffices">Наурызбай
                                                        батыра,19
                                                    </a>
                                                </li>
                                                <li class="nav__separate">
                                                    <h4 class="nav__title submenu">Центры прямых продаж</h4>
                                                </li>
                                                <li class="suboffices_main">
                                                    <a ofct="Алматы" id="show167" style="" data-tab data-geo="43.239484, 76.908110"
                                                       class="js-map-toggle link nav__item suboffices">пр.Абая, 60
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="menuwraper disaktau"><h4 class="nav__title">Головной офис</h4>
                                            <ul class="nav__list">
                                                <li>
                                                    <a ofct="Актау" id="show157" style="" data-tab
                                                       data-geo="43.647838, 51.153686"
                                                       class="js-map-toggle link nav__item headoffices">9-й мкр., д. 29
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="menuwraper disaktobe"><h4 class="nav__title">Головной офис</h4>
                                            <ul class="nav__list">
                                                <li>
                                                    <a ofct="Актобе" id="show108" style="" data-tab
                                                       data-geo="50.300891, 57.151118,*+7 (7132) 547-587"
                                                       class="js-map-toggle link nav__item headoffices">Пацаева, 6
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="menuwraper disatyrau"><h4 class="nav__title">Головной офис</h4>
                                            <ul class="nav__list">
                                                <li>
                                                    <a ofct="Атырау" id="show110" style="" data-tab
                                                       data-geo="47.095814, 51.925061"
                                                       class="js-map-toggle link nav__item headoffices">М.Өтемісұлы, 121
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="menuwraper diskaraganda"><h4 class="nav__title">Головной офис</h4>
                                            <ul class="nav__list">
                                                <li>
                                                    <a ofct="Караганда" id="show111" style="" data-tab
                                                       data-geo="49.803791, 73.098942"
                                                       class="js-map-toggle link nav__item headoffices">Н.Абдирова, 17
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="menuwraper diskokshetau"><h4 class="nav__title">Головной офис</h4>
                                            <ul class="nav__list">
                                                <li>
                                                    <a ofct="Кокшетау" id="show112" style="" data-tab
                                                       data-geo="53.289116, 69.399666"
                                                       class="js-map-toggle link nav__item headoffices">Ауэзова, 268
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="menuwraper diskostanay"><h4 class="nav__title">Головной офис</h4>
                                            <ul class="nav__list">
                                                <li>
                                                    <a ofct="Костанай" id="show113" style="" data-tab
                                                       data-geo="53.230187, 63.616713"
                                                       class="js-map-toggle link nav__item headoffices">Темирбаева, 39
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="menuwraper diskyzylorda"><h4 class="nav__title">Головной офис</h4>
                                            <ul class="nav__list">
                                                <li>
                                                    <a ofct="Кызылорда" id="show114" style="" data-tab
                                                       data-geo="44.846935, 65.502324"
                                                       class="js-map-toggle link nav__item headoffices">Байтурсынова, 47
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="menuwraper disnur-sultan"><h4 class="nav__title">Головной офис</h4>
                                            <ul class="nav__list">
                                                <li>
                                                    <a ofct="Нур-Султан" id="show105" style="" data-tab
                                                       data-geo="51.1684, 71.4136,*+7 7172 32-85-09"
                                                       class="js-map-toggle link nav__item headoffices">пр. Женис,16
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="menuwraper dispavlodar"><h4 class="nav__title">Головной офис</h4>
                                            <ul class="nav__list">
                                                <li>
                                                    <a ofct="Павлодар" id="show115" style="" data-tab
                                                       data-geo="52.283423, 76.972836"
                                                       class="js-map-toggle link nav__item headoffices">Естая, 89
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="menuwraper dispetropavlovsk"><h4 class="nav__title">Головной
                                                офис</h4>
                                            <ul class="nav__list">
                                                <li>
                                                    <a ofct="Петропавловск" id="show116" style="" data-tab
                                                       data-geo="54.861058, 69.163508"
                                                       class="js-map-toggle link nav__item headoffices">Батыр Баян, 30
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="menuwraper dissemey"><h4 class="nav__title">Головной офис</h4>
                                            <ul class="nav__list">
                                                <li>
                                                    <a ofct="Семей" id="show117" style="" data-tab
                                                       data-geo="50.415406, 80.254907"
                                                       class="js-map-toggle link nav__item headoffices">Шакерима, 54
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="menuwraper distaldykorgan"><h4 class="nav__title">Головной офис</h4>
                                            <ul class="nav__list">
                                                <li>
                                                    <a ofct="Талдыкорган" id="show118" style="" data-tab
                                                       data-geo="45.015806, 78.374161"
                                                       class="js-map-toggle link nav__item headoffices">Шевченко, 140
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="menuwraper distaraz"><h4 class="nav__title">Головной офис</h4>
                                            <ul class="nav__list">
                                                <li>
                                                    <a ofct="Тараз" id="show119" style="" data-tab
                                                       data-geo="42.901570, 71.374741"
                                                       class="js-map-toggle link nav__item headoffices">Толе би, 38
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="menuwraper disturkestan"><h4 class="nav__title">Головной офис</h4>
                                            <ul class="nav__list">
                                                <li>
                                                    <a ofct="Туркестан" id="show109" style="" data-tab
                                                       data-geo="51.823414, 68.360201"
                                                       class="js-map-toggle link nav__item headoffices">Тауке Хан, 246
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="menuwraper disural-sk"><h4 class="nav__title">Головной офис</h4>
                                            <ul class="nav__list">
                                                <li>
                                                    <a ofct="Уральск" id="show120" style="" data-tab
                                                       data-geo="51.212613, 51.366348"
                                                       class="js-map-toggle link nav__item headoffices">Нурсултана
                                                        Назарбаева, 203
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="menuwraper disust--kamenogorsk"><h4 class="nav__title">Головной
                                                офис</h4>
                                            <ul class="nav__list">
                                                <li>
                                                    <a ofct="Усть-Каменогорск" id="show121" style="" data-tab
                                                       data-geo="49.960349, 82.604844"
                                                       class="js-map-toggle link nav__item headoffices">пр. Нурсултана
                                                        Назарбаева, 22
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="menuwraper disshymkent"><h4 class="nav__title">Головной офис</h4>
                                            <ul class="nav__list">
                                                <li>
                                                    <a ofct="Шымкент" id="show84" style="" data-tab
                                                       data-geo="42.316041, 69.608206"
                                                       class="js-map-toggle link nav__item headoffices">Тауке хана, 47
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                        </ul>
                                    </nav>
                                </aside>
                                <!-- .contacts__nav -->
                                <section class="contacts__info">
                                    <div class="tab-panels contacts__adress" data-tabs-content>
                                        <div class="tab-panels__item headoffices show78" data-tabs-pane>
                                            <div class="address">
                                                <div style="font-weight: bold;"><span
                                                        style="vertical-align: inherit;"><span
                                                            style="vertical-align: inherit;"><span
                                                                style="vertical-align: inherit;"><span
                                                                    style="vertical-align: inherit;">Акционерное общество "Страховая компания" Коммеск-Өмір "</span></span></span></span>
                                                </div>
                                                <div class="address__place"><span style="vertical-align: inherit;"><span
                                                            style="vertical-align: inherit;"><span
                                                                style="vertical-align: inherit;"><span
                                                                    style="vertical-align: inherit;">г. </span></span></span><span
                                                            style="vertical-align: inherit;"><span
                                                                style="vertical-align: inherit;"><span
                                                                    style="vertical-align: inherit;">Алматы, ул. </span></span></span><span
                                                            style="vertical-align: inherit;"><span
                                                                style="vertical-align: inherit;"><span
                                                                    style="vertical-align: inherit;">Наурызбай батыра, 19, уг. </span></span></span><span
                                                            style="vertical-align: inherit;"><span
                                                                style="vertical-align: inherit;"><span
                                                                    style="vertical-align: inherit;">ул. </span></span></span><span
                                                            style="vertical-align: inherit;"><span
                                                                style="vertical-align: inherit;"><span
                                                                    style="vertical-align: inherit;">Макатаева</span></span></span></span>
                                                </div>
                                                <div class="address__time">
                                                    <div style="word-spacing: 1.1px;"><strong><span
                                                                style="vertical-align: inherit;"><span
                                                                    style="vertical-align: inherit;"><span
                                                                        style="vertical-align: inherit;"><span
                                                                            style="vertical-align: inherit;">График работы:</span></span></span></span></strong>
                                                    </div>
                                                    <div style="word-spacing: 1.1px;"><span
                                                            style="vertical-align: inherit;"><span
                                                                style="vertical-align: inherit;"><span
                                                                    style="vertical-align: inherit;"><span
                                                                        style="vertical-align: inherit;">9.00-18.00 - будние дни</span></span></span></span>
                                                    </div>
                                                    <div><span style="vertical-align: inherit;"><span
                                                                style="vertical-align: inherit;"><span
                                                                    style="vertical-align: inherit;"><span
                                                                        style="vertical-align: inherit;">13.00-14.00 - обед</span></span></span></span>
                                                    </div>
                                                    <div><span style="vertical-align: inherit;"><span
                                                                style="vertical-align: inherit;">Выходной - Сб., Вс.</span></span>
                                                    </div>
                                                    <div><span style="vertical-align: inherit;"><span
                                                                style="vertical-align: inherit;"><span
                                                                    style="vertical-align: inherit;"><span
                                                                        style="vertical-align: inherit;">+7 727 244 74 00</span></span></span></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-panels__item suboffices show78" data-tabs-pane>
                                            <div class="address">
                                                <div style="font-weight: bold;"><span
                                                        style="vertical-align: inherit;"><span
                                                            style="vertical-align: inherit;"><span
                                                                style="vertical-align: inherit;"><span
                                                                    style="vertical-align: inherit;">Акционерное общество "Страховая компания" Коммеск-Өмір "</span></span></span></span>
                                                </div>
                                                <div class="address__place"><span style="vertical-align: inherit;"><span
                                                            style="vertical-align: inherit;"><span
                                                                style="vertical-align: inherit;"><span
                                                                    style="vertical-align: inherit;">г. </span></span></span><span
                                                            style="vertical-align: inherit;"><span
                                                                style="vertical-align: inherit;"><span
                                                                    style="vertical-align: inherit;">Алматы, ул. </span></span></span><span
                                                            style="vertical-align: inherit;"><span
                                                                style="vertical-align: inherit;"><span
                                                                    style="vertical-align: inherit;">Наурызбай батыра, 19, уг. </span></span></span><span
                                                            style="vertical-align: inherit;"><span
                                                                style="vertical-align: inherit;"><span
                                                                    style="vertical-align: inherit;">ул. </span></span></span><span
                                                            style="vertical-align: inherit;"><span
                                                                style="vertical-align: inherit;"><span
                                                                    style="vertical-align: inherit;">Макатаева</span></span></span></span>
                                                </div>
                                                <div class="address__time">
                                                    <div style="word-spacing: 1.1px;"><strong><span
                                                                style="vertical-align: inherit;"><span
                                                                    style="vertical-align: inherit;"><span
                                                                        style="vertical-align: inherit;"><span
                                                                            style="vertical-align: inherit;">График работы:</span></span></span></span></strong>
                                                    </div>
                                                    <div style="word-spacing: 1.1px;"><span
                                                            style="vertical-align: inherit;"><span
                                                                style="vertical-align: inherit;"><span
                                                                    style="vertical-align: inherit;"><span
                                                                        style="vertical-align: inherit;">9.00-18.00 - будние дни</span></span></span></span>
                                                    </div>
                                                    <div><span style="vertical-align: inherit;"><span
                                                                style="vertical-align: inherit;"><span
                                                                    style="vertical-align: inherit;"><span
                                                                        style="vertical-align: inherit;">13.00-14.00 - обед</span></span></span></span>
                                                    </div>
                                                    <div><span style="vertical-align: inherit;"><span
                                                                style="vertical-align: inherit;">Выходной - Сб., Вс.</span></span>
                                                    </div>
                                                    <div><span style="vertical-align: inherit;"><span
                                                                style="vertical-align: inherit;"><span
                                                                    style="vertical-align: inherit;"><span
                                                                        style="vertical-align: inherit;">+7 727 244 74 00</span></span></span></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-panels__item headoffices show167" data-tabs-pane>
                                            <div class="address">
                                                <div style="font-weight: bold;">г.&nbsp;Алматы, пр. Абая,&nbsp;60</div>
                                                <div style="font-weight: bold;">&nbsp;</div>
                                                <div class="address__place">&nbsp;</div>
                                                <div class="address__time">
                                                    <div style="word-spacing: 1.1px;"><strong><span
                                                                style="vertical-align: inherit;">График работы:</span></strong>
                                                    </div>
                                                    <div style="word-spacing: 1.1px;"><span
                                                            style="vertical-align: inherit;">9.00-18.00 &ndash; будние дни</span>
                                                    </div>
                                                    <div><span
                                                            style="vertical-align: inherit;">13.00-14.00 &ndash; обед</span>
                                                    </div>
                                                    <div>Выходной &ndash; Сб., Вс.</div>
                                                    <div><span style="vertical-align: inherit;">+7 727 244 74 00</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-panels__item suboffices show167" data-tabs-pane>
                                            <div class="address">
                                                <div style="font-weight: bold;">г.&nbsp;Алматы, пр. Абая,&nbsp;60</div>
                                                <div style="font-weight: bold;">&nbsp;</div>
                                                <div class="address__place">&nbsp;</div>
                                                <div class="address__time">
                                                    <div style="word-spacing: 1.1px;"><strong><span
                                                                style="vertical-align: inherit;">График работы:</span></strong>
                                                    </div>
                                                    <div style="word-spacing: 1.1px;"><span
                                                            style="vertical-align: inherit;">9.00-18.00 &ndash; будние дни</span>
                                                    </div>
                                                    <div><span
                                                            style="vertical-align: inherit;">13.00-14.00 &ndash; обед</span>
                                                    </div>
                                                    <div>Выходной &ndash; Сб., Вс.</div>
                                                    <div><span style="vertical-align: inherit;">+7 727 244 74 00</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-panels__item headoffices show157" data-tabs-pane>
                                            <div class="address">
                                                <div class="address__place"><span style="vertical-align: inherit;"><span
                                                            style="vertical-align: inherit;">г. </span><span
                                                            style="vertical-align: inherit;">Актау, 9-й мкр., Д. </span><span
                                                            style="vertical-align: inherit;">29, офис 77</span></span>
                                                </div>
                                                <div class="address__place"><span style="vertical-align: inherit;"><span
                                                            style="vertical-align: inherit;">с 09:00 до 18:00 - будние дни</span></span>
                                                </div>
                                                <div><span style="vertical-align: inherit;"><span
                                                            style="vertical-align: inherit;">с 10:00 до 15:00 - Сб.</span></span>
                                                </div>
                                                <div><span style="vertical-align: inherit;"><span
                                                            style="vertical-align: inherit;">Выходной - Вс.</span></span>
                                                </div>
                                                <div><span style="vertical-align: inherit;"><span
                                                            style="vertical-align: inherit;">+7 (7292) 43-72-22</span></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-panels__item suboffices show157" data-tabs-pane>
                                            <div class="address">
                                                <div class="address__place"><span style="vertical-align: inherit;"><span
                                                            style="vertical-align: inherit;">г. </span><span
                                                            style="vertical-align: inherit;">Актау, 9-й мкр., Д. </span><span
                                                            style="vertical-align: inherit;">29, офис 77</span></span>
                                                </div>
                                                <div class="address__place"><span style="vertical-align: inherit;"><span
                                                            style="vertical-align: inherit;">с 09:00 до 18:00 - будние дни</span></span>
                                                </div>
                                                <div><span style="vertical-align: inherit;"><span
                                                            style="vertical-align: inherit;">с 10:00 до 15:00 - Сб.</span></span>
                                                </div>
                                                <div><span style="vertical-align: inherit;"><span
                                                            style="vertical-align: inherit;">Выходной - Вс.</span></span>
                                                </div>
                                                <div><span style="vertical-align: inherit;"><span
                                                            style="vertical-align: inherit;">+7 (7292) 43-72-22</span></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-panels__item headoffices show108" data-tabs-pane>
                                            <div class="address">
                                                <div class="address__place">г. Актобе, ул. Пацаева, 6, оф.4</div>
                                                <!-- .address__place -->
                                                <div class="address__time">
                                                    <div>10:00-17:00 &ndash; будние дни</div>
                                                    <div>Выходной &ndash; Сб., Вс.</div>
                                                </div>
                                                <!-- .address__time -->
                                                <div>+7(7132)54-75-87<br/>+7(7132)56-17-99<br/>+7(7132)24-36-93</div>
                                                <!-- .address__phones -->
                                                <p>&nbsp;</p>
                                            </div>
                                        </div>
                                        <div class="tab-panels__item suboffices show108" data-tabs-pane>
                                            <div class="address">
                                                <div class="address__place">г. Актобе, ул. Пацаева, 6, оф.4</div>
                                                <!-- .address__place -->
                                                <div class="address__time">
                                                    <div>10:00-17:00 &ndash; будние дни</div>
                                                    <div>Выходной &ndash; Сб., Вс.</div>
                                                </div>
                                                <!-- .address__time -->
                                                <div>+7(7132)54-75-87<br/>+7(7132)56-17-99<br/>+7(7132)24-36-93</div>
                                                <!-- .address__phones -->
                                                <p>&nbsp;</p>
                                            </div>
                                        </div>
                                        <div class="tab-panels__item headoffices show110" data-tabs-pane>
                                            <div class="address">
                                                <div class="address__place">г. Атырау, ул. М. Өтемісұлы, 121, кв.53
                                                </div>
                                                <div class="address__place">09:00-18:00 &ndash; будние дни</div>
                                                <div class="address__time">
                                                    <div>Выходной &ndash; Сб., Вс.</div>
                                                </div>
                                                <!-- .address__time -->
                                                <div>+7(7122)25-17-36<br/>+7(7122)25-04-50<br/>+7(7122)55-81-55</div>
                                                <!-- .address__phones -->
                                            </div>
                                        </div>
                                        <div class="tab-panels__item suboffices show110" data-tabs-pane>
                                            <div class="address">
                                                <div class="address__place">г. Атырау, ул. М. Өтемісұлы, 121, кв.53
                                                </div>
                                                <div class="address__place">09:00-18:00 &ndash; будние дни</div>
                                                <div class="address__time">
                                                    <div>Выходной &ndash; Сб., Вс.</div>
                                                </div>
                                                <!-- .address__time -->
                                                <div>+7(7122)25-17-36<br/>+7(7122)25-04-50<br/>+7(7122)55-81-55</div>
                                                <!-- .address__phones -->
                                            </div>
                                        </div>
                                        <div class="tab-panels__item headoffices show111" data-tabs-pane>
                                            <div class="address">
                                                <div class="address__place"><span style="vertical-align: inherit;"><span
                                                            style="vertical-align: inherit;">г. </span><span
                                                            style="vertical-align: inherit;">Караганда, ул. </span><span
                                                            style="vertical-align: inherit;">Н.Абдирова, 17 </span></span><br/><span
                                                        style="vertical-align: inherit;"><span
                                                            style="vertical-align: inherit;">09:00-17:00 &ndash; будние дни </span></span><br/><span
                                                        style="vertical-align: inherit;"><span
                                                            style="vertical-align: inherit;">Выходной &ndash; Сб., Вс. </span></span><br/><span
                                                        style="vertical-align: inherit;"><span
                                                            style="vertical-align: inherit;">+7 (7212) 47-69-32</span></span>
                                                </div>
                                                <div class="address__time">&nbsp;</div>
                                                <!-- .address__phones -->
                                            </div>
                                        </div>
                                        <div class="tab-panels__item suboffices show111" data-tabs-pane>
                                            <div class="address">
                                                <div class="address__place"><span style="vertical-align: inherit;"><span
                                                            style="vertical-align: inherit;">г. </span><span
                                                            style="vertical-align: inherit;">Караганда, ул. </span><span
                                                            style="vertical-align: inherit;">Н.Абдирова, 17 </span></span><br/><span
                                                        style="vertical-align: inherit;"><span
                                                            style="vertical-align: inherit;">09:00-17:00 &ndash; будние дни </span></span><br/><span
                                                        style="vertical-align: inherit;"><span
                                                            style="vertical-align: inherit;">Выходной &ndash; Сб., Вс. </span></span><br/><span
                                                        style="vertical-align: inherit;"><span
                                                            style="vertical-align: inherit;">+7 (7212) 47-69-32</span></span>
                                                </div>
                                                <div class="address__time">&nbsp;</div>
                                                <!-- .address__phones -->
                                            </div>
                                        </div>
                                        <div class="tab-panels__item headoffices show112" data-tabs-pane>
                                            <div class="address">
                                                <div class="address__place">г. Кокшетау, ул. Ауэзова, 268, н.п.86</div>
                                                <!-- .address__place -->
                                                <div class="address__time">
                                                    <div>09:00-18:00 &ndash; будние дни.</div>
                                                    <div>Выходной &ndash; Сб., Вс.</div>
                                                </div>
                                                <!-- .address__time -->
                                                <div>+7(7162)50-22-20<br/>+7(7162)50-22-21</div>
                                                <!-- .address__phones -->
                                            </div>
                                        </div>
                                        <div class="tab-panels__item suboffices show112" data-tabs-pane>
                                            <div class="address">
                                                <div class="address__place">г. Кокшетау, ул. Ауэзова, 268, н.п.86</div>
                                                <!-- .address__place -->
                                                <div class="address__time">
                                                    <div>09:00-18:00 &ndash; будние дни.</div>
                                                    <div>Выходной &ndash; Сб., Вс.</div>
                                                </div>
                                                <!-- .address__time -->
                                                <div>+7(7162)50-22-20<br/>+7(7162)50-22-21</div>
                                                <!-- .address__phones -->
                                            </div>
                                        </div>
                                        <div class="tab-panels__item headoffices show113" data-tabs-pane>
                                            <div class="address">
                                                <div class="address__place"><span style="vertical-align: inherit;"><span
                                                            style="vertical-align: inherit;">г. </span><span
                                                            style="vertical-align: inherit;">Костанай, ул.</span><span
                                                            style="vertical-align: inherit;">Темирбаева, 39</span></span>
                                                </div>
                                                <!-- .address__place -->
                                                <div class="address__time">
                                                    <div><span style="vertical-align: inherit;"><span
                                                                style="vertical-align: inherit;">09:00-18:00 &ndash; будние дни</span></span>
                                                    </div>
                                                    <div>Выходной &ndash; Сб., Вс.</div>
                                                </div>
                                                <!-- .address__time -->
                                                <div><span style="vertical-align: inherit;"><span
                                                            style="vertical-align: inherit;">+7 (7142) 90-08-89</span></span>
                                                </div>
                                                <!-- .address__phones -->
                                            </div>
                                        </div>
                                        <div class="tab-panels__item suboffices show113" data-tabs-pane>
                                            <div class="address">
                                                <div class="address__place"><span style="vertical-align: inherit;"><span
                                                            style="vertical-align: inherit;">г. </span><span
                                                            style="vertical-align: inherit;">Костанай, ул.</span><span
                                                            style="vertical-align: inherit;">Темирбаева, 39</span></span>
                                                </div>
                                                <!-- .address__place -->
                                                <div class="address__time">
                                                    <div><span style="vertical-align: inherit;"><span
                                                                style="vertical-align: inherit;">09:00-18:00 &ndash; будние дни</span></span>
                                                    </div>
                                                    <div>Выходной &ndash; Сб., Вс.</div>
                                                </div>
                                                <!-- .address__time -->
                                                <div><span style="vertical-align: inherit;"><span
                                                            style="vertical-align: inherit;">+7 (7142) 90-08-89</span></span>
                                                </div>
                                                <!-- .address__phones -->
                                            </div>
                                        </div>
                                        <div class="tab-panels__item headoffices show114" data-tabs-pane>
                                            <div class="address">
                                                <div class="address__place">г. Кызылорда, ул. Аскара Токмагамбетова,
                                                    д.27, кв.16
                                                </div>
                                                <!-- .address__place -->
                                                <div class="address__time">
                                                    <div>09:00-17:00 &ndash; будние дни</div>
                                                    <div>Выходной &ndash; Сб., Вс.</div>
                                                    <div>+7(7242)27-08-65</div>
                                                </div>
                                                <!-- .address__phones -->
                                            </div>
                                        </div>
                                        <div class="tab-panels__item suboffices show114" data-tabs-pane>
                                            <div class="address">
                                                <div class="address__place">г. Кызылорда, ул. Аскара Токмагамбетова,
                                                    д.27, кв.16
                                                </div>
                                                <!-- .address__place -->
                                                <div class="address__time">
                                                    <div>09:00-17:00 &ndash; будние дни</div>
                                                    <div>Выходной &ndash; Сб., Вс.</div>
                                                    <div>+7(7242)27-08-65</div>
                                                </div>
                                                <!-- .address__phones -->
                                            </div>
                                        </div>
                                        <div class="tab-panels__item headoffices show105" data-tabs-pane>
                                            <div class="address">
                                                <div class="address__place">г. Нур-Султан, пр. Женис, 16, кв.10</div>
                                                <div class="address__place">09:00-18:00 - будние дни<br/>Выходной
                                                    &ndash; Сб., Вс.
                                                </div>
                                                <div class="address__phones list--nostyle">
                                                    <div>+7(7172)32-85-09</div>
                                                    <div>+7(7172)44-54-11
                                                        <div>+7(7172)32-00-26</div>
                                                        <div>+7(7172)94-51-65</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-panels__item suboffices show105" data-tabs-pane>
                                            <div class="address">
                                                <div class="address__place">г. Нур-Султан, пр. Женис, 16, кв.10</div>
                                                <div class="address__place">09:00-18:00 - будние дни<br/>Выходной
                                                    &ndash; Сб., Вс.
                                                </div>
                                                <div class="address__phones list--nostyle">
                                                    <div>+7(7172)32-85-09</div>
                                                    <div>+7(7172)44-54-11
                                                        <div>+7(7172)32-00-26</div>
                                                        <div>+7(7172)94-51-65</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-panels__item headoffices show115" data-tabs-pane>
                                            <div class="address">
                                                <div class="address__place">г. Павлодар, ул. Естая, 89, оф. 106</div>
                                                <!-- .address__place -->
                                                <div class="address__time">
                                                    <div>09:00-18:00 &ndash; будние дни</div>
                                                    <div>Выходной &ndash; Сб., Вс.</div>
                                                </div>
                                                <!-- .address__time -->
                                                <div>+7(7182)50-94-05<br/>+7(7182)50-94-04</div>
                                                <!-- .address__phones -->
                                            </div>
                                        </div>
                                        <div class="tab-panels__item suboffices show115" data-tabs-pane>
                                            <div class="address">
                                                <div class="address__place">г. Павлодар, ул. Естая, 89, оф. 106</div>
                                                <!-- .address__place -->
                                                <div class="address__time">
                                                    <div>09:00-18:00 &ndash; будние дни</div>
                                                    <div>Выходной &ndash; Сб., Вс.</div>
                                                </div>
                                                <!-- .address__time -->
                                                <div>+7(7182)50-94-05<br/>+7(7182)50-94-04</div>
                                                <!-- .address__phones -->
                                            </div>
                                        </div>
                                        <div class="tab-panels__item headoffices show116" data-tabs-pane>
                                            <div class="address">
                                                <div class="address__place"><span style="vertical-align: inherit;"><span
                                                            style="vertical-align: inherit;"><span
                                                                style="vertical-align: inherit;"><span
                                                                    style="vertical-align: inherit;">г. </span></span></span><span
                                                            style="vertical-align: inherit;"><span
                                                                style="vertical-align: inherit;"><span
                                                                    style="vertical-align: inherit;">Петропавловск, ул. </span><span
                                                                    style="vertical-align: inherit;">М.Жумабаева </span></span></span><span
                                                            style="vertical-align: inherit;"><span
                                                                style="vertical-align: inherit;"><span
                                                                    style="vertical-align: inherit;">, 101</span></span></span></span>
                                                </div>
                                                <div class="address__place"><span style="vertical-align: inherit;"><span
                                                            style="vertical-align: inherit;">09: 00-18: 00 - будние дни</span></span>
                                                </div>
                                                <div class="address__time">
                                                    <div><span style="vertical-align: inherit;"><span
                                                                style="vertical-align: inherit;">Выходной - Сб., Вс.</span></span>
                                                    </div>
                                                    <div><span style="vertical-align: inherit;"><span
                                                                style="vertical-align: inherit;"><span
                                                                    style="vertical-align: inherit;"><span
                                                                        style="vertical-align: inherit;">+7 (7152) 522-299</span></span></span></span>
                                                    </div>
                                                </div>
                                                <!-- .address__phones -->
                                            </div>
                                        </div>
                                        <div class="tab-panels__item suboffices show116" data-tabs-pane>
                                            <div class="address">
                                                <div class="address__place"><span style="vertical-align: inherit;"><span
                                                            style="vertical-align: inherit;"><span
                                                                style="vertical-align: inherit;"><span
                                                                    style="vertical-align: inherit;">г. </span></span></span><span
                                                            style="vertical-align: inherit;"><span
                                                                style="vertical-align: inherit;"><span
                                                                    style="vertical-align: inherit;">Петропавловск, ул. </span><span
                                                                    style="vertical-align: inherit;">М.Жумабаева </span></span></span><span
                                                            style="vertical-align: inherit;"><span
                                                                style="vertical-align: inherit;"><span
                                                                    style="vertical-align: inherit;">, 101</span></span></span></span>
                                                </div>
                                                <div class="address__place"><span style="vertical-align: inherit;"><span
                                                            style="vertical-align: inherit;">09: 00-18: 00 - будние дни</span></span>
                                                </div>
                                                <div class="address__time">
                                                    <div><span style="vertical-align: inherit;"><span
                                                                style="vertical-align: inherit;">Выходной - Сб., Вс.</span></span>
                                                    </div>
                                                    <div><span style="vertical-align: inherit;"><span
                                                                style="vertical-align: inherit;"><span
                                                                    style="vertical-align: inherit;"><span
                                                                        style="vertical-align: inherit;">+7 (7152) 522-299</span></span></span></span>
                                                    </div>
                                                </div>
                                                <!-- .address__phones -->
                                            </div>
                                        </div>
                                        <div class="tab-panels__item headoffices show117" data-tabs-pane>
                                            <div class="address">
                                                <div class="address__place">г. Семей, ул. Шакерима, 54</div>
                                                <!-- .address__place -->
                                                <div class="address__time">
                                                    <div>09:00-18:00 &ndash; будние дни.</div>
                                                    <div>Выходной &ndash; Сб., Вс.</div>
                                                </div>
                                                <!-- .address__time -->
                                                <div>+7(7222)56-24-92<br/>+7(7222)52-18-49</div>
                                                <!-- .address__phones -->
                                            </div>
                                        </div>
                                        <div class="tab-panels__item suboffices show117" data-tabs-pane>
                                            <div class="address">
                                                <div class="address__place">г. Семей, ул. Шакерима, 54</div>
                                                <!-- .address__place -->
                                                <div class="address__time">
                                                    <div>09:00-18:00 &ndash; будние дни.</div>
                                                    <div>Выходной &ndash; Сб., Вс.</div>
                                                </div>
                                                <!-- .address__time -->
                                                <div>+7(7222)56-24-92<br/>+7(7222)52-18-49</div>
                                                <!-- .address__phones -->
                                            </div>
                                        </div>
                                        <div class="tab-panels__item headoffices show118" data-tabs-pane>
                                            <div class="address">
                                                <div class="address">
                                                    <div class="address__place">г. Талдыкорган, ул. Шевченко, 140,
                                                        кв.2
                                                    </div>
                                                    <!-- .address__place -->
                                                    <div class="address__time">
                                                        <div>09:00-18:00 &ndash; будние дни</div>
                                                        <div>Выходной &ndash; Сб., Вс.</div>
                                                    </div>
                                                    <!-- .address__time -->
                                                    <div>+7(7282)24-26-21</div>
                                                </div>
                                                <!-- .address__phones -->
                                            </div>
                                        </div>
                                        <div class="tab-panels__item suboffices show118" data-tabs-pane>
                                            <div class="address">
                                                <div class="address">
                                                    <div class="address__place">г. Талдыкорган, ул. Шевченко, 140,
                                                        кв.2
                                                    </div>
                                                    <!-- .address__place -->
                                                    <div class="address__time">
                                                        <div>09:00-18:00 &ndash; будние дни</div>
                                                        <div>Выходной &ndash; Сб., Вс.</div>
                                                    </div>
                                                    <!-- .address__time -->
                                                    <div>+7(7282)24-26-21</div>
                                                </div>
                                                <!-- .address__phones -->
                                            </div>
                                        </div>
                                        <div class="tab-panels__item headoffices show119" data-tabs-pane>
                                            <div class="address">
                                                <div class="address__place">г. Тараз, ул. Толе би, 38, кв. 2</div>
                                                <!-- .address__place -->
                                                <div class="address__time">
                                                    <div>09:00-17:00 &ndash; будние дни</div>
                                                    <div>Выходной &ndash; Сб., Вс.</div>
                                                    <div>+7(7262)51-21-11</div>
                                                </div>
                                                <!-- .address__phones -->
                                            </div>
                                        </div>
                                        <div class="tab-panels__item suboffices show119" data-tabs-pane>
                                            <div class="address">
                                                <div class="address__place">г. Тараз, ул. Толе би, 38, кв. 2</div>
                                                <!-- .address__place -->
                                                <div class="address__time">
                                                    <div>09:00-17:00 &ndash; будние дни</div>
                                                    <div>Выходной &ndash; Сб., Вс.</div>
                                                    <div>+7(7262)51-21-11</div>
                                                </div>
                                                <!-- .address__phones -->
                                            </div>
                                        </div>
                                        <div class="tab-panels__item headoffices show109" data-tabs-pane>
                                            <div class="address">
                                                <div class="address__place"><span style="vertical-align: inherit;"><span
                                                            style="vertical-align: inherit;">г. </span><span
                                                            style="vertical-align: inherit;">Туркестан, пр.</span><span
                                                            style="vertical-align: inherit;">&nbsp;Тауке Хан, дом 246</span></span>
                                                </div>
                                                <!-- .address__place -->
                                                <div class="address__time">
                                                    <div><span style="vertical-align: inherit;"><span
                                                                style="vertical-align: inherit;">09:00-18:00 &ndash; будние дни.</span></span>
                                                    </div>
                                                    <div>Выходной &ndash; Сб., Вс.</div>
                                                </div>
                                                <!-- .address__time -->
                                                <div class="address__phones">&nbsp;</div>
                                                <!-- .address__phones -->
                                            </div>
                                        </div>
                                        <div class="tab-panels__item suboffices show109" data-tabs-pane>
                                            <div class="address">
                                                <div class="address__place"><span style="vertical-align: inherit;"><span
                                                            style="vertical-align: inherit;">г. </span><span
                                                            style="vertical-align: inherit;">Туркестан, пр.</span><span
                                                            style="vertical-align: inherit;">&nbsp;Тауке Хан, дом 246</span></span>
                                                </div>
                                                <!-- .address__place -->
                                                <div class="address__time">
                                                    <div><span style="vertical-align: inherit;"><span
                                                                style="vertical-align: inherit;">09:00-18:00 &ndash; будние дни.</span></span>
                                                    </div>
                                                    <div>Выходной &ndash; Сб., Вс.</div>
                                                </div>
                                                <!-- .address__time -->
                                                <div class="address__phones">&nbsp;</div>
                                                <!-- .address__phones -->
                                            </div>
                                        </div>
                                        <div class="tab-panels__item headoffices show120" data-tabs-pane>
                                            <div class="address">
                                                <div class="address__place">г. Уральск, пр. Нурсултана Назарбаева, 203,
                                                    кв. 127.
                                                </div>
                                                <!-- .address__place -->
                                                <div class="address__time">
                                                    <div>09:00-17:00 &ndash; будние дни</div>
                                                    <div>Выходной &ndash; Сб., Вс.</div>
                                                </div>
                                                <!-- .address__time -->
                                                <div>+7(7112)51-39-79<br/>+7(7112)55-47-02</div>
                                                <!-- .address__phones -->
                                            </div>
                                        </div>
                                        <div class="tab-panels__item suboffices show120" data-tabs-pane>
                                            <div class="address">
                                                <div class="address__place">г. Уральск, пр. Нурсултана Назарбаева, 203,
                                                    кв. 127.
                                                </div>
                                                <!-- .address__place -->
                                                <div class="address__time">
                                                    <div>09:00-17:00 &ndash; будние дни</div>
                                                    <div>Выходной &ndash; Сб., Вс.</div>
                                                </div>
                                                <!-- .address__time -->
                                                <div>+7(7112)51-39-79<br/>+7(7112)55-47-02</div>
                                                <!-- .address__phones -->
                                            </div>
                                        </div>
                                        <div class="tab-panels__item headoffices show121" data-tabs-pane>
                                            <div class="address">
                                                <div class="address__place"><span style="vertical-align: inherit;"><span
                                                            style="vertical-align: inherit;">г. </span><span
                                                            style="vertical-align: inherit;">Усть-Каменогорск, пр.Нурсултана Назарбаева, 22, н.п.18</span></span>
                                                </div>
                                                <!-- .address__place -->
                                                <div class="address__time">
                                                    <div><span style="vertical-align: inherit;"><span
                                                                style="vertical-align: inherit;">09:00-17:00 &ndash; будние дни</span></span>
                                                    </div>
                                                    <div><span style="vertical-align: inherit;"><span
                                                                style="vertical-align: inherit;">Выходной &ndash; Сб., Вс.</span></span>
                                                    </div>
                                                </div>
                                                <!-- .address__time -->
                                                <div><span style="vertical-align: inherit;"><span
                                                            style="vertical-align: inherit;">+7 (7232) 76-78-14&nbsp;</span></span>
                                                </div>
                                                <div><span style="vertical-align: inherit;"><span
                                                            style="vertical-align: inherit;">+7 (7232) 76-78-89</span></span>
                                                </div>
                                                <!-- .address__phones -->
                                            </div>
                                        </div>
                                        <div class="tab-panels__item suboffices show121" data-tabs-pane>
                                            <div class="address">
                                                <div class="address__place"><span style="vertical-align: inherit;"><span
                                                            style="vertical-align: inherit;">г. </span><span
                                                            style="vertical-align: inherit;">Усть-Каменогорск, пр.Нурсултана Назарбаева, 22, н.п.18</span></span>
                                                </div>
                                                <!-- .address__place -->
                                                <div class="address__time">
                                                    <div><span style="vertical-align: inherit;"><span
                                                                style="vertical-align: inherit;">09:00-17:00 &ndash; будние дни</span></span>
                                                    </div>
                                                    <div><span style="vertical-align: inherit;"><span
                                                                style="vertical-align: inherit;">Выходной &ndash; Сб., Вс.</span></span>
                                                    </div>
                                                </div>
                                                <!-- .address__time -->
                                                <div><span style="vertical-align: inherit;"><span
                                                            style="vertical-align: inherit;">+7 (7232) 76-78-14&nbsp;</span></span>
                                                </div>
                                                <div><span style="vertical-align: inherit;"><span
                                                            style="vertical-align: inherit;">+7 (7232) 76-78-89</span></span>
                                                </div>
                                                <!-- .address__phones -->
                                            </div>
                                        </div>
                                        <div class="tab-panels__item headoffices show84" data-tabs-pane>
                                            <div class="address">
                                                <div class="address__place"><span style="vertical-align: inherit;"><span
                                                            style="vertical-align: inherit;">г. </span><span
                                                            style="vertical-align: inherit;">Шымкент, ул. Майлы Кожа</span><span
                                                            style="vertical-align: inherit;">, 17, кв. 62</span></span>
                                                </div>
                                                <div class="address__time">
                                                    <div><span style="vertical-align: inherit;"><span
                                                                style="vertical-align: inherit;">09: 00-18: 00 &ndash; будние дни</span></span>
                                                    </div>
                                                    <div><span style="vertical-align: inherit;"><span
                                                                style="vertical-align: inherit;">Выходной &ndash; Сб., Вс.</span></span>
                                                    </div>
                                                    <div><span style="vertical-align: inherit;"><span
                                                                style="vertical-align: inherit;">+7 (7252) 53-74-88&nbsp;</span></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-panels__item suboffices show84" data-tabs-pane>
                                            <div class="address">
                                                <div class="address__place"><span style="vertical-align: inherit;"><span
                                                            style="vertical-align: inherit;">г. </span><span
                                                            style="vertical-align: inherit;">Шымкент, ул. Майлы Кожа</span><span
                                                            style="vertical-align: inherit;">, 17, кв. 62</span></span>
                                                </div>
                                                <div class="address__time">
                                                    <div><span style="vertical-align: inherit;"><span
                                                                style="vertical-align: inherit;">09: 00-18: 00 &ndash; будние дни</span></span>
                                                    </div>
                                                    <div><span style="vertical-align: inherit;"><span
                                                                style="vertical-align: inherit;">Выходной &ndash; Сб., Вс.</span></span>
                                                    </div>
                                                    <div><span style="vertical-align: inherit;"><span
                                                                style="vertical-align: inherit;">+7 (7252) 53-74-88&nbsp;</span></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- .contacts__info -->

                                    <div class="contacts__map map js-map-container" id="map">
                                        <div class="map__message">
                                            <svg class="map__icon" xmlns="http://www.w3.org/2000/svg" width="48"
                                                 height="65">
                                                <path fill-rule="evenodd" fill="currentColor"
                                                      d="M25.014 63.767L24 64.997l-1.014-1.23C21.972 62.648 0 36.582 0 23.828 0 10.739 10.817 0 24 0s23.999 10.739 23.999 23.828c0 12.754-22.084 38.82-22.985 39.939zM24 2.797c-11.718 0-21.183 9.397-21.183 21.031 0 10.293 16.788 31.436 21.183 36.918 4.394-5.482 21.183-26.625 21.183-36.918 0-11.634-9.465-21.031-21.183-21.031zm0 38.595c-9.916 0-18.028-8.054-18.028-17.899S14.084 5.593 24 5.593c9.915 0 18.028 8.055 18.028 17.9 0 9.845-8.113 17.899-18.028 17.899zM24 8.39c-8.338 0-15.211 6.824-15.211 15.103 0 8.278 6.873 15.102 15.211 15.102 8.338 0 15.211-6.824 15.211-15.102C39.211 15.214 32.338 8.39 24 8.39z"/>
                                            </svg>
                                            Офис открылся недавно, <br>карты пока нет
                                        </div>
                                        <!-- .map__message -->
                                    </div>
                                    <!-- #map.contacts__map js-map-container -->
                                </section>
                                <!-- .contacts__info -->
                            </div>
                            <!-- .grid contacts__grid -->
                        </section>


                        <!-- end content -->
                        <section class="content">
                            <div class="grid">
                                <dl class="contacts__mails">
                                    <dt class="as-h4">Для прессы</dt>
                                    <dd><a href="mailto:pressa@kommesk-omir.kz" class="link">pressa@kommesk-omir.kz</a>
                                    </dd>
                                    <dt class="as-h4">Для отправки предложений</dt>
                                    <dd><a href="mailto:marketing@kommesk-omir.kz" class="link">marketing@kommesk-omir.kz</a>
                                    </dd>
                                    <dt class="as-h4">По всем вопросам</dt>
                                    <dd><a href="mailto:almaty@kommesk-omir.kz" class="link">almaty@kommesk-omir.kz</a>
                                    </dd>
                                    <dd><a href="mailto:call-center@kommesk-omir.kz" class="link">call-center@kommesk-omir.kz</a>
                                    </dd>
                                </dl>


                                <section class="feedback callb1" id="callb1">
                                    <h3 class="feedback__title">{{ __('navbar.bc3')}}</h3>
                                    <form action="#" method="" id="call-popup">
                                        <div class="grid">
                                            <input type="hidden" id="frompage" class="field" name="frompage" value="Контакты
                                            https://ckl.kz/contacts">
                                            <fieldset class="field-set col col--full" style="">
                                                <label class="field-set__label">{{ __('navbar.bc4')}}</label>
                                                <input  type="text" class="field" onkeyup="showOrHideBlock('fullname_error1','fullname1')" id="fullname1" name="fullname" >

                                                <strong><small id="fullname_error1" class="form-text text-" style="display: none;  color: crimson">Поле ФИО должно быть заполнено!</small></strong>
                                            </fieldset>

                                            <fieldset class="field-set col col--1-2" style="">
                                                <label class="field-set__label">{{ __('navbar.bc5')}}</label>
                                                <input type="tel"  class="field tel-masked" id="phone-input1" onkeyup="showOrHideBlock('phone_error1','phone-input1')" name="phone" placeholder="Номер мобильного или городского" >
                                                <strong> <small id="phone_error1" class="form-text text-" style="display: none; color: crimson">Поле номер должно быть заполнено!</small></strong>
                                            </fieldset>



                                            <fieldset class="field-set col col--1-2" style="">
                                                <label class="field-set__label">Эл. почта</label>
                                                <input type="email" class="field" name="email" id="email1"
                                                       onclick="$(this).css('border-color','#ccc')"/></fieldset>

                                            <fieldset class="field-set col col--full" style="">
                                    <textarea class="field" name="qst" value="" id="qst" placeholder="Ваш вопрос" rows="5"></textarea></fieldset>



                                            <script>
                                                function showOrHideBlock(errorBlock,manipulationBlock){
                                                    $('#'+errorBlock).hide();
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
                                                    function calldate2312() {

                                                        $("#call-popup-call-date").val('2020-02-03 11:18');
                                                        $("#call-popup-call-date").closest('fieldset').addClass('has-success');

                                                    }

                                                    setTimeout(calldate2312, 2000);

                                                    /* Скрипты для формы Обратного звонка */
                                                    window.onload = function () {
                                                        // Зададим стартовую дату
                                                        var start = new Date(),
                                                            prevDay,
                                                            startHours = 9;
                                                        // 09:00
                                                        start.setHours(9);
                                                        start.setMinutes(0);
                                                        // Если сегодня суббота или воскресенье - 10:00
                                                        if ([6, 0].indexOf(start.getDay()) != -1) {
                                                            start.setHours(10);
                                                            startHours = 10
                                                        }
                                                        var dp = $('.modal [data-callback-time]').data('datepicker');
                                                        dp.update({
                                                            minDate: start,
                                                            startDate: start,
                                                            minHours: startHours,
                                                            maxHours: 18,
                                                            autoClose: true,
                                                            onSelect: function (fd, d, picker) {
                                                                // Ничего не делаем если выделение было снято
                                                                if (!d) return;
                                                                var day = d.getDay();
                                                                // Обновляем состояние календаря только если была изменена дата
                                                                if (prevDay != undefined && prevDay == day) return;
                                                                prevDay = day;
                                                                // Если выбранный день суббота или воскресенье, то устанавливаем
                                                                // часы для выходных, в противном случае восстанавливаем начальные значения
                                                                if (day == 6 || day == 0) {
                                                                    picker.update({
                                                                        minHours: 10,
                                                                        maxHours: 16
                                                                    })
                                                                } else {
                                                                    picker.update({
                                                                        minHours: 9,
                                                                        maxHours: 18
                                                                    })
                                                                }
                                                            }
                                                        })


                                                    }
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
                                                        // alert('контактный аяах');
                                                        var fullname = $("#fullname1").val();
                                                        var phone = $("#phone-input1").val();
                                                        var email = $('#email1').val();
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
                                                                frompage: frompage

                                                            },
                                                            beforeSend: function () {
                                                                let a = false;
                                                                if(fullname=='') {
                                                                    // alert('Поле ФИО у нас обязательное для заполнения!');
                                                                    // $("#fullname").val("ошибка");
                                                                    $("#fullname_error1").show();
                                                                    a = true;
                                                                }
                                                                if(phone==''){
                                                                    $("#phone_error1").show();
                                                                    a = true;
                                                                }
                                                                if(a) return false;

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
                                                                    $(".callb1").html('<h3 style="color:springgreen">Спасибо за обращение!</h3> С Вами свяжутся по номеру <strong style="color:black;">+7' + phone + '</strong> в указанное в заявке время.');
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

                        </section>
                                </div>
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
