@extends('layouts.general')

@section('content')


            <div class="article-wrapper">
                <dd>
                    <span class="period">{{ $title }}</span>
                    <h4></h4>
                    <span class="attachment">
                            {!! $text !!}

                        </a>
              </span><br>


                </dd>
                <br>

                <div class="container">
                    <nav class="pagination" id="nav__list">
                        <ul class="pagination__list">
                            <li>
                                <a href="{{ route('about.akcioneram') }}" class="link pagination__link">
                                    1
                                </a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>

            <!-- end tiles -->
        </div>
        <!-- end container -->
    </main>
    <!-- end main -->
@endsection
