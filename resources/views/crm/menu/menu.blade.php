<q-list highlight no-border>
    @foreach(App\Models\Menu::crm() as $menu)
        <a href="@if ($menu->slug) /crm/{{$menu->slug}} @else  /  @endif">
            <q-item link>
                <q-item-side>
                    <q-icon name="{{ $menu->icon }}"/>
                </q-item-side>
                <q-item-main>
                    <q-item-tile label>{{ $menu->name }}</q-item-tile>
                </q-item-main>
            </q-item>
        </a>
    @endforeach
</q-list>

