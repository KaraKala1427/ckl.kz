@if(App::getLocale()  === 'ru')
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

@else

    <tr>
        <th>Сақтандыру кезені</th>
        <td style="border: none;"><span style="font-weight: bold">12 ай</span></td>
    </tr>
    <tr>
        <th>Жалпы сақтандыру шарттары</th>
        <th>2-ші бағдарлама</th>
    </tr>
    <tr>
        <th>Жалпы сақтандыру сомасы</th>
        <td>2 000 000</td>
    </tr>
    <tr>
        <th>Ауруханаға жатқызу</th>
        <td>200 000</td>
    </tr>
    <tr>
        <th>Өлім</th>
        <td>1 800 000</td>
    </tr>
    <tr>
        <th>Сақтандыру сыйлықақысы</th>
        <td>18 000</td>
    </tr>
    <tr>
        <th>Жылдық мөлшерлеме</th>
        <td>0,90%</td>
    </tr>

@endif
