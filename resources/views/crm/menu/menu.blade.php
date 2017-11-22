@foreach(App\Models\Menu::crm() as $menu)

    <a href="@if ($menu->slug) /crm/{{$menu->slug}} @else  /  @endif"
       title="{{ $menu->name }}"
       class="admin-menu {{ explode('/',Request::getRequestUri())[2] === $menu->slug ? "active" : "" }} ">
        <div>
            <span class="icon">
            <i class="fa fa-lg {{ $menu->icon }}"></i>
            </span>
        </div>
        <div>
            <span class="is-size-7">{{ $menu->name }}</span>
        </div>
    </a>

@endforeach

