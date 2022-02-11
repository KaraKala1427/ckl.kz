@extends('layouts.general')


@section('content')

    <h2>«Оплата прошла успешно. Но договор не подписан. Произошел технический сбой.
        Просим подождать….»</h2>

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
