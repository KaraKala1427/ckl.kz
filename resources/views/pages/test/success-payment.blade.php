@extends('layouts.general')


@section('content')

    @if(!empty($order->email))

        <h3><b>{{__('navbar.success_payment_halyk')}}</b></h3>
        <h3>{{__('navbar.contract')}} №{{ $order->policy_result }} {{__('navbar.sent_on_your_email')}} {{ $order->email }}.</h3>

    @else

        <h3><b>{{__('navbar.success_payment_halyk')}}</b></h3>
        <h3>{{__('navbar.contract')}} №{{ $order->policy_result }}</h3>

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



    </main>

@endsection
