@auth
    <div class="sidebar sidebar-admin" style="width: 21%;">
        <div class="sidebar-wrapper ps" style="   background: #0098f0; ">
            <div class="logo">
                <a href="javascript:void(0)" class="simple-text logo-mini">

                </a>
                <a href="javascript:void(0)" class="simple-text logo-normal">
                   Centras Kommesk Life
                </a>
            </div>
{{--            @php(dd("before component",$menu))--}}
          <x-sidebar-component :menu="$menu">
          </x-sidebar-component>
        </div>
    </div>
@endauth
