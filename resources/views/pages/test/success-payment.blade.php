@extends('layouts.general')


@section('content')


    <h3><b>Договор успешно подписан !!!</b>></h3>
    <h3>Номер договора : {{ $order->policy_result }}</h3>


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


    </main>

@endsection
