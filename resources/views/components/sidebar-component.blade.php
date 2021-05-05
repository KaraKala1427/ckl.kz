<ul class="nav ">
    @foreach($menu as $key => $item)
    <li>
        @if(count($item->children ?? []) > 0)
            @if($item->link == "link24")
                <a data-toggle="collapse" href="#{{$item->link}}" aria-expanded="false" class="collapsed">
                    <i class="fab fa-laravel"></i>
                    <span class="nav-link-text">{{$item->name_ru}} ({{ count($item->children ?? []) }})</span>
                    <b class="caret mt-1"></b>
                </a>

                <div class="collapse" id="{{$item->link}}" style="">
                    <ul class="nav pl-4">
                        <x-sidebar-component :items="$item->children"></x-sidebar-component>
                    </ul>
                </div>
            @else
            <a data-toggle="collapse" href="#{{$item->link}}" aria-expanded="true" class>
                <i class="fab fa-laravel"></i>
                <span class="nav-link-text">{{$item->name_ru}} ({{ count($item->children ?? []) }})</span>
                <b class="caret mt-1"></b>
            </a>

            <div class="collapse show" id="{{$item->link}}" style="">
                <ul class="nav pl-4">
                    <x-sidebar-component :items="$item->children"></x-sidebar-component>
                </ul>
            </div>
            @endif


        @else
{{--            вот здесь для последнего меню добавляю чуть падинг снизу для скроллинга ,
                а то не скроллится, конечно это не правильно что я условие поставил статично ,а не динамично  --}}
            @if($item->link == "link77")
                <li style="padding-bottom: 7rem;">
                    <a href="{{ route('admin.one.menu', ["link" =>$item->link ]) }}">
                        <i class="tim-icons icon-pin"></i>
                        <p>{{$item->name_ru}}</p>
                    </a>
                </li>
            @else
                <li>
                    <a href="{{ route('admin.one.menu', ["link" =>$item->link ]) }}">
                        <i class="tim-icons icon-pin"></i>
                        <p>{{$item->name_ru}}</p>
                    </a>
                </li>
            @endif
        @endif

    </li>
    @endforeach
{{--    <li>--}}

{{--        <a data-toggle="collapse" href="#laravel-examples" aria-expanded="false" class="collapsed">--}}
{{--            <i class="fab fa-laravel"></i>--}}
{{--            <span class="nav-link-text">test</span>--}}
{{--            <b class="caret mt-1"></b>--}}
{{--        </a>--}}

{{--        <div class="collapse" id="laravel-examples" style="">--}}
{{--            <ul class="nav pl-4">--}}
{{--                <li class="active ">--}}
{{--                    <a href="https://black-dashboard-laravel.creative-tim.com/profile">--}}
{{--                        <i class="tim-icons icon-single-02"></i>--}}
{{--                        <p>User Profile</p>--}}
{{--                    </a>--}}
{{--                </li>--}}
{{--                <li>--}}
{{--                    <a href="https://black-dashboard-laravel.creative-tim.com/user">--}}
{{--                        <i class="tim-icons icon-bullet-list-67"></i>--}}
{{--                        <p>User Management</p>--}}
{{--                    </a>--}}
{{--                </li>--}}
{{--            </ul>--}}
{{--        </div>--}}
{{--    </li>--}}
</ul>
