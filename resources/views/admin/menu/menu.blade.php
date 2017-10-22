@foreach(App\Models\Menu::admin() as $menu)

    <a href="@if ($menu->slug) /admin/{{$menu->slug}} @else  /  @endif"
       title="{{ $menu->name }}"
       class="ui-p-1 ui-color col-greyBlueLL hover admin-menu {{ explode('/',Request::getRequestUri())[2] === $menu->slug ? "active" : "" }} ">

        <div class="ui-icon">
            {{ $menu->icon }}
        </div>
        <div class="ui-fnt thin size-0">
            {{ $menu->name }}
        </div>

    </a>

@endforeach