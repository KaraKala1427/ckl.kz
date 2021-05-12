@if($attributes['type']=='mobile')
    <nav class="nav nav--lang">
        <ul class="nav__list">
            @foreach ($params as $lang =>  $data)
                <li><a href="{{ route('setlocale',$data) }}" style="padding: 10px;  margin-left: -15px">
                        {{ $lang }}
                    </a></li>
            @endforeach

        </ul>
        <!-- .nav__list -->
    </nav>
@else
    <div class="dropdown dropdown--light">
        <div class="dropdown__toggle button button--hollow">{{ App::getLocale()}}</div>
        {{--                    <div class="dropdown__toggle button button--hollow">Ру</div>--}}
        <div class="dropdown__menu">
            <div class="dropdown__content">
                <ul class="dropdown__list">

                    @foreach ($params as $lang =>  $data)
                        <li><a href="{{ route('setlocale',$data) }}">
                                {{ $lang }}
                            </a></li>
                    @endforeach

                </ul>
            </div>
        </div>
    </div>

@endif
