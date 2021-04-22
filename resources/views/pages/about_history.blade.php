@extends('layouts.general')
@section('content')



    <section class="history content">
        <h1 class="content__title">{{ __('history') }}</h1>
        <div class="history__wrap">
            <div class="frame frame--over">
                <div class="slidee grid">
                    @foreach($years as $key => $year)
                        <div class="history__year year">
                            <h2 class="history__date history__date--big date text-grey">{{ $year }}</h2>
                            <div class="year__grid">
                                <div class="year__item">
                                    <div class="year__card card card--border card--year">
                                        <h4 class="card__title">{{ $articles[$key]->{'name_'  .App::getLocale()} }}</h4>
                                        <div class="card__desc">
                                            {!!  $articles[$key]->{'tex_'  .App::getLocale()} !!}
                                            <br/></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="scrollbar">
                <div class="handle">
                    <div class="mousearea"></div>
                </div>
            </div>
        </div>
    </section>
    </div>
    </main>
    <!-- end main -->
@endsection
