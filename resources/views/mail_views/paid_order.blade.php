<p><b>Номер договора</b> : {{$agr_id}}</p>
<p>Номер заказа          : {{$order_id}}</p>
<p>ФИО                   : {{$first_name}} {{$last_name}}</p>
<p>ИИН                   : {{$iin}}</p>
<p>Номер                 : {{$phone}}</p>
<p>Почта                 : {{$email}}</p>
<p>На сумму              : {{$premium}} тг</p>
<p>ИСН программы         : {{$programISN}}
    @if($programISN == '898641')
        (Программа 1)
    @elseif($programISN == '898651')
        (Программа 2)
    @elseif($programISN == '898661')
        (Программа 3)
    @endif
</p>
<p>ИСН договора          : {{$agr_isn}}</p>
<p>Дата начала договора  : {{$date_start}}</p>
<p>Дата окончания договора  : {{$date_end}}</p>

