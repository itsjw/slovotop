<q-toolbar slot="header" color="blue-grey-14">

    <q-btn flat @click="$refs.layout.toggleLeft()">
        <q-icon name="fa-bars"/>
    </q-btn>

    <q-toolbar-title>
        @yield('HeadTitle')
    </q-toolbar-title>

    <a href="{{ route('logout') }}">
        <q-btn flat color="white" icon="fa-sign-out">
            {{ \Auth::user()->name }}
        </q-btn>
    </a>

</q-toolbar>