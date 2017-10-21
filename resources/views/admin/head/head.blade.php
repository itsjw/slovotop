<div class="ui-grid-block">
    <div class="ui-grid-10"></div>
    <div class="ui-grid-2">

        <a href="{{ route('logout') }}" class="ui-color col-greyBlue hover ui-grid-block right ui-pr-3">
            <div class="ui-fnt light ui-mr-2">
                {{ Auth::user()->name }}
            </div>
            <i class="ui-icon">exit_to_app</i>
        </a>

    </div>
</div>