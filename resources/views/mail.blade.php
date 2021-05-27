<h1>Имя : {{ $fullname }}</h1>
<p>Номер : +7{{$phone}}</p>
<p>Дата : {{$call_date}}</p>
@if($call_now)
<p>Позвонить сейчас : да</p>
@else
    <p>Позвонить сейчас : нет</p>
@endif



