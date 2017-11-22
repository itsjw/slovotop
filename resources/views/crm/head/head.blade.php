<nav class="navbar">
    <div class="navbar-start">
        <div class="navbar-item">
            @yield('HeadTitle')
        </div>
    </div>
    <div class="navbar-end">
        <div class="navbar-item">
            <a href="http://slovo.zz/logout" class="button is-info">
                <span class="icon">
                    <i class="fa fa-sign-out"></i>
                </span>
                <span>{{ \Auth::user()->name }}</span>
            </a>
        </div>
    </div>
</nav>