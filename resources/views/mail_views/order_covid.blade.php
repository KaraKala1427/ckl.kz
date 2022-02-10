<p>Номер заказа          : {{$order_id}}</p>
@if($agentName != null)
    <p>Агент             : {{$agentName}}</p>
@endif
@if($agentFullName != null)
    <p>Оператор ввода    : {{$agentFullName}}</p>
@endif
<p>ФИО                   : {{$last_name}} {{$first_name}} {{$middle_name}} </p>
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


