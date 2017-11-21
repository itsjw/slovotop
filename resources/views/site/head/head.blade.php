<nav class="navbar is-link">
    <div class="container">
        <div class="navbar-brand">
            <a class="navbar-item" href="{{ route('home') }}">
                Logo
            </a>
        </div>

        <div class="navbar-menu">
            <div class="navbar-end">
                @include('site.head.right')
            </div>
        </div>
    </div>
</nav>