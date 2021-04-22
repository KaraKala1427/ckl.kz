<div class="dropdown dropdown--light">
    <div class="dropdown__toggle button button--hollow">{{ App::getLocale()}}</div>
    {{--                    <div class="dropdown__toggle button button--hollow">Ру</div>--}}
    <div class="dropdown__menu">
        <div class="dropdown__content">
            <ul class="dropdown__list">

                @foreach ($params as $lang =>  $data)
                    <li><a href="{{ route(request()->route()->getName(),$data ) }}">
                            {{ $lang }}
                        </a></li>
                @endforeach

            </ul>
        </div>
    </div>
</div>
