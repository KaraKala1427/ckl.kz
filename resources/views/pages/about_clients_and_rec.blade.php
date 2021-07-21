@extends('layouts.general')

@section('content')
    <section class="awards content">
        <h1 class="awards__title content__title">@lang('navbar.mf25')</h1>
        <!-- end .awards__title -->
        <div class="awards__grid grid">
            @foreach($articles as $article)
            <div class="awards__item awards__item--fold">
                <div class="awards__card awards__card--center">
                    <a href="{{$article->img_ru}}" class="js-lightbox-trigger overlay"></a>
                    <!-- .overlay -->
                    <figure class="awards__image">
                        <img src="{{$article->img_ru}}">
                    </figure>
                    <!-- end.awards__image -->
                    <div class="awards__year">
                    </div>
                    <!-- .awards__year -->
                    <span class="awards__name">{{$article->name_ru}}</span>
                </div>
                <!-- end .awards__card -->
            </div>
            @endforeach
        </div>
        <!-- end .awards__grid grid -->

    </section>
    <!-- end .awards content -->
    </div>
    <!-- end container -->
    </main>
    <!-- end main -->


@endsection
