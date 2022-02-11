@extends('layouts.general')


@section('content')

    @if(!empty($order->email))

        <h3><b>Оплата прошла успешно. Поздравляем с приобретением страховой защиты.</b></h3>
        <h3>Договор №{{ $order->policy_result }} отправлен на Ваш электронный {{ $order->email }}.</h3>

    @else

        <h3><b>Оплата прошла успешно. Поздравляем с приобретением страховой защиты.</b></h3>
        <h3>Договор №{{ $order->policy_result }}</h3>

    @endif

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

        .nav__list {
            display: none;
        }
    </style>

    <script>


        if (localStorage.getItem("reload{{$order->id ?? ''}}") === "false") {
            localStorage.removeItem("reload");
        } else {
            localStorage.setItem("reload{{$order->id ?? ''}}", "false");
            window.location = window.location;
        }


    </script>



    </main>

@endsection
