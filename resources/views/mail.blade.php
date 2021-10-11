<p>Имя : {{ $fullname }}</p>
<p>Номер : +7{{$phone}}</p>
<p>Удобное время (время Астаны) : {{$callDate}}</p>
<p>Позвоните прямо сейчас :
    @if($callNow == "true")
        Да
    @elseif($callNow == "false")
        Нет
    @endif
</p>




