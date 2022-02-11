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
