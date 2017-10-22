@guest
    <a href="{{ route('login') }}" class="ui-color col-greyBlueLL hover ui-grid-block right">
        <div class="ui-fnt light ui-mr-2">
            @lang('data.login')
        </div>
        <i class="ui-icon">perm_identity</i>
    </a>
@endguest

@auth
    <div class="ui-grid-block">
        <div class="ui-grid-6">
            <a href="@if(Auth::user()->hasRole(1)) {{ route('adminHome') }} @else {{ route('userHome') }} @endif"
               class="ui-color col-greyBlueLL hover ui-grid-block right">
                <div class="ui-fnt light ui-mr-2">
                    {{ Auth::user()->name }}
                </div>
                <i class="ui-icon">person</i>
            </a>
        </div>
        <div class="ui-grid-6">
            <a href="{{ route('logout') }}" class="ui-color col-greyBlueLL hover ui-grid-block right">
                <div class="ui-fnt light ui-mr-2">
                    @lang('data.logout')
                </div>
                <i class="ui-icon">exit_to_app</i>
            </a>
        </div>
    </div>

@endauth