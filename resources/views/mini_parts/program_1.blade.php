@if(App::getLocale()  === 'ru')
    <tr>
        <th>Период страхования</th>
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
@else

    <tr>
        <th colspan="">Сақтандыру кезені</th>
        <td style="border: none;"><span style="font-weight: bold">12 ай</span></td>
    </tr>

    <tr>
        <th>Жалпы сақтандыру шарттары</th>
        <th>1-ші бағдарлама</th>
    </tr>
    <tr>
        <th>Жалпы сақтандыру сомасы</th>
        <td>1 000 000</td>
    </tr>
    <tr>
        <th>Ауруханаға жатқызу</th>
        <td>100 000</td>
    </tr>
    <tr>
        <th>Өлім</th>
        <td>900 000</td>
    </tr>
    <tr>
        <th>Сақтандыру сыйлықақысы</th>
        <td>9 900</td>
    </tr>
    <tr>
        <th>Жылдық мөлшерлеме</th>
        <td>0,99%</td>
    </tr>


@endif
