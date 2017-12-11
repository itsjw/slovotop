<nav class="navbar">

    <div class="navbar-start">
        <div class="navbar-item">
            <h1 class="title is-5">@yield('HeadTitle')</h1>
        </div>
    </div>

    <div class="navbar-end">
        <div class="navbar-item">
            <a href="{{ route('logout') }}" class="button is-info">
                <span class="icon">
                    <i class="fa fa-sign-out"></i>
                </span>
                <span>{{ \Auth::user()->name }}</span>
            </a>
        </div>
    </div>

</nav>