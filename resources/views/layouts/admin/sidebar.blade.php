@auth
    <div class="sidebar" style="width: 23%;">
        <!--
          Tip 1: You can change the color of the sidebar using: data-color="blue | green | orange | red"
      -->
        <div class="sidebar-wrapper ps" style="   background: #0098f0; ">




            <div class="logo">
                <a href="javascript:void(0)" class="simple-text logo-mini">

                </a>
                <a href="javascript:void(0)" class="simple-text logo-normal">
                   Centras Kommesk Life
                </a>
            </div>
          <x-sidebar-component>

          </x-sidebar-component>
{{--                @endforeach--}}
{{--                @foreach($menus as $menu)--}}
{{--                <li class="">--}}
{{--                    <a href="{{ route('admin.one.menu', ["link" =>$menu->link ]) }}">--}}
{{--                        <i class="tim-icons icon-chart-pie-36"></i>--}}
{{--                        <p>{{$menu->name_ru}}</p>--}}
{{--                    </a>--}}
{{--                </li>--}}
{{--                @endforeach--}}

        </div>
    </div>
@endauth
