@extends('layouts.general')


@section('content')

    @if(!empty($order->email))

        <h3><b>«Оплата прошла успешно. Поздравляем с приобретением страховой защиты.</b></h3>
        <h3>Договор №{{ $order->policy_result }} отправлен на Ваш электронный {{ $order->email }}.»</h3>

    @else

        <h3><b>«Оплата прошла успешно. Поздравляем с приобретением страховой защиты.</b></h3>
        <h3>Договор №{{ $order->policy_result }}»</h3>

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

        (function () {
            if (window.localStorage) {
                if (!localStorage.getItem('firstLoad')) {
                    localStorage['firstLoad'] = true;
                    window.location.reload();
                } else
                    localStorage.removeItem('firstLoad');
            }
        })();


    </script>



    </main>

@endsection
