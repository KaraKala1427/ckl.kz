@extends('layouts.general')

@section('content')

    <div class="tiles">

        @foreach($articles as $article)
            <div class="tiles__card card card--promo card--border ">

                <div class="card__body">
                    @if($article->{'pubdat'} != '')
                        <div class="card__period"><span class="period">{{ (new \Illuminate\Support\Carbon($article->pubdat))->format('Y-m-d') }}</span></div>
                    @else
                        {{ null }}
                    @endif
                    <h4 class="card__title">
                        <a href="{{ $article->route() }}" class="link" style="font-size: 27px;">
                            @if($article-> {'name_'.App::getLocale() } != '')
                                {{$article-> {'name_'.App::getLocale() } }}
                            @else
                                {{$article-> {'name_ru' } }}
                            @endif
                        </a>

                    </h4>
                    <em>
                    </em>
                    <div class="card__desc destroy_text">
                        @if($article->{'tex_'.App::getLocale() } != '')
                            {!! $article-> {'tex_'.App::getLocale() } !!}
                        @else
                            {!! $article-> {'tex_ru' } !!}
                        @endif
                    </div>
                </div>
            </div>
        @endforeach

    </div>
    <div class="container" id="container">
        <nav class="pagination">
            <ul class="pagination__list">
                @foreach($years as $year)
                    <li>
                        <a href="{{route('press_by_year', [$year]) }}" class="link pagination__link" >
                            {{$year}}
                        </a>
                    </li>
                @endforeach
            </ul>
            <div >
                {{$articles->links()}}
            </div>
        </nav>
    </div>


    <style>
        .removejust {
            display: none;
        }
        hr.spotline {
            color: #ededed;
        }
        .destroy_text {
            height: 95px;
            overflow: hidden;
            text-overflow: ellipsis;
        }
        @media (max-width: 991px) {
            main {
                padding: 0 0;

            }
        }
    </style>
    <script>
        if($('.card__desc > div').text().lenght > 200){
            addClass('destroy_text');
        };
    </script>
    </div>       <!-- end tiles -->
    </div>
    <!-- end container -->
    </main>
    <!-- end main -->

@endsection
