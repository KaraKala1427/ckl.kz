    <table class="table table-bordered covid-program">
        <tr>
            <th colspan="5" class="font-weight-bolder">Условия страхования ненакопительного (срочного) страхования жизни
                на случай заболевания
                COVID-19 KZZZZZWWW
            </th>
        </tr>
        <tbody>
        <tr>
            <th colspan="5" class="font-weight-bolder">1.Описание</th>
        </tr>
        <tr>
            <th scope="row">Условия оплаты</th>
            <td colspan="5" style="border: none;">единовременно</td>
        </tr>
        <tr>
            <th scope="row">Срок страхования</th>
            <td style="border: none;">12 месяцев</td>
        </tr>
        <tr>
            <th>Покрываемые риски</th>
            <td colspan="5" style="border: none">- диагностированное и приведшее к госпитализации Застрахованного
                заболевание, вызванное коронавирусной инфекцией COVID-19, один раз в
                период действия страховой защиты;
                <br>
                - смерть Застрахованного, наступившая в период действия договора
                страхования в результате заболевания, вызванного коронавирусной
                инфекцией COVID-19, за исключением случаев, предусмотренных Договором
                и/или Правилами.
            </td>
        </tr>
        <tr>
            <th scope="row">Возрастные ограничения</th>
            <td colspan="5" style="border: none">от 18 года до 65 лет</td>
        </tr>
        <tr>
            <th scope="row">Лимиты ответственности</th>
            <td colspan="5" style="border: none">100% от страховой суммы установленной риску</td>
        </tr>
        <tr>
            <th scope="row">Территория покрытия</th>
            <td colspan="5" style="border: none">Республика Казахстан</td>
        </tr>
        </tbody>
        <tr>
            <th colspan="5" class="font-weight-bolder">2.Расчет</th>
        </tr>
        @if(request('id') == "1")
            @include('mini_parts.program_1')
        @elseif(request('id') == "2")
            @include('mini_parts.program_2')
        @elseif(request('id') == "3")
            @include('mini_parts.program_3')
        @else
            <tr>
                <th>Период страхования</th>
                <td style="border: none;"><span style="font-weight: bold"> 12 месяцев</span></td>
            </tr>
            <tr>
                <th>Условия</th>
                <th>Программа 1</th>
                <th>Программа 2</th>
                <th>Программа 3</th>
            </tr>
            <tr>
                <th>Общая страховая сумма</th>
                <td>1 000 000</td>
                <td>2 000 000</td>
                <td>3 000 000</td>
            </tr>
            <tr>
                <th>Госпитализация</th>
                <td>100 000</td>
                <td>200 000</td>
                <td>300 000</td>
            </tr>
            <tr>
                <th>Смерть</th>
                <td>900 000</td>
                <td>1 800 000</td>
                <td>2 700 000</td>
            </tr>
            <tr>
                <th>Страховая премия</th>
                <td>9 900</td>
                <td>18 000</td>
                <td>26 100</td>
            </tr>
            <tr>
                <th>Годовой тариф</th>
                <td>0,99%</td>
                <td>0,90%</td>
                <td>0,87%</td>
            </tr>
        @endif
        <tr>
            <th colspan="5" class="font-weight-bolder">3. Страховые выплаты</th>
        </tr>
        <tr>
            <th scope="row">Госпитализация</th>
            <td colspan="" style="border: none">100% от страховой суммы по данному риску</td>
        </tr>
        <tr>
            <th scope="row">Смерть</th>
            <td style="border: none">100% от страховой суммы по данному риску</td>
        </tr>
        <tr>
            <th colspan="5" class="font-weight-bolder">4. Особые условия:</th>
        </tr>
        <tr>
            <td colspan="5" style="border: none;">1. Страхователем является Резидент Республики Казахстан.
                Застрахованный
                является Страхователем.
            </td>
        </tr>
        <tr>
            <td colspan="5" style="border: none">2. Выгодоприобретателем по госпитализации является Страхователь.
                Выгодоприобретателями в случае смерти являются
                наследники Застрахованного в соответсвии с законодательством РК.
            </td>
        </tr>
        <tr>
            <td colspan="2" style="border: none">3. Период страхования
                равен периоду страховой защиты.
            </td>
        </tr>
        <tr>
            <td colspan="3" style="border: none">4. Период действия страховой защиты начинается по истечении 7 (семи)
                календарных дней после
                подписания/заключения договора страхования.
            </td>
        </tr>
    </table>


