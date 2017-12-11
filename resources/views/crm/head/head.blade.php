<nav class="navbar is-light">

    <div class="navbar-start">
        <div class="navbar-item">
            <h1 class="title is-2">@yield('HeadTitle')</h1>
        </div>
    </div>

    <div class="navbar-end">
        <div class="navbar-item">
            <a href="{{ route('logout') }}" class="button is-info">
                <span>{{ \Auth::user()->name }}</span>
                <span class="icon">
                    <i class="mdi mdi-logout"></i>
                </span>
            </a>
        </div>
    </div>

</nav>