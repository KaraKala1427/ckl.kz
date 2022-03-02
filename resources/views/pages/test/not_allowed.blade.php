@extends('layouts.general')

@section('content')
    <div>
        <h1>{{__('navbar.not_allowed_covid_epay')}}</h1>
    </div>

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
