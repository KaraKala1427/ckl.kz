<p>Имя : {{ $fullname }}</p>
<p>Номер : +7{{$phone}}</p>
<p>Почта : {{$email}}</p>
<p>Удобное время (время Астаны) : {{$callDate}}</p>
<p>Позвоните прямо сейчас :
    @if($callNow == "true")
        Да
    @elseif($callNow == "false")
        Нет
    @endif
</p>
<p>Вопрос : {!! $qst !!}</p>
<p>Со страницы : {{ $frompage }}</p>

