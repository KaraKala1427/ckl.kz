<ul class="nav">
    @php(dd("componnent",$menu))
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
                        <x-sidebar-component :menu="$item->children"></x-sidebar-component>
                    </ul>
                </div>
            @else
            <a data-toggle="collapse" href="#{{$item->link}}"  aria-expanded="true" class>
                <i class="fab fa-laravel"></i>
                <span class="nav-link-text" onclick="window.open('http://127.0.0.1:8000/admin/menu/{{$item->link}}','_self');">{{$item->name_ru}} ({{ count($item->children ?? []) }})</span>
                <b class="caret mt-1"></b>
            </a>

            <div class="collapse show" id="{{$item->link}}" style="">
                <ul class="nav pl-4">
                    <x-sidebar-component :menu="$item->children"></x-sidebar-component>
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

</ul>
