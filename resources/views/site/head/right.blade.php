@guest
    <div class="navbar-item">
        <a class="button is-warning" href="{{ route('login') }}">
            <span class="icon">
                <i class="fa fa-sign-in"></i>
            </span>
            <span>@lang('data.login')</span>
        </a>
    </div>
@endguest

@auth

    <div class="navbar-item">
        <div class="field is-grouped">
            <a class="button is-primary control" href="{{ route('crmHome') }}">
                <span class="icon">
                    <i class="fa fa-user"></i>
                </span>
                <span>
                    {{ Auth::user()->name }}
                </span>
            </a>

            <a class="button" href="{{ route('logout') }}">
            <span class="icon">
                <i class="fa fa-sign-out"></i>
            </span>
                <span>@lang('data.logout')</span>
            </a>
        </div>

    </div>

@endauth