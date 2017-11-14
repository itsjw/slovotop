@extends('site.index')

@section('content')

    <div class="ui-center">

        <div class="ui-grid-block center ui-mt-6">

            <div class="ui-grid-4">

                <form method="post" action="{{ route('auth') }}">
                    <div class="ui-fnt medium ui-color col-greyBlue ui-mt-3">
                        @lang('data.userEmail')
                    </div>
                    <input class="ui-input-line green focus" type="text" name="email">

                    <div class="ui-fnt medium ui-color col-greyBlue ui-mt-3">
                        @lang('data.userPassword')
                    </div>
                    <input class="ui-input-line green focus" type="password" name="password">

                    <div class="ui-grid-block ui-mt-5">
                        <div class="ui-fnt medium ui-color col-greyBlue ui-mr-3">
                            @lang('data.userRemember')
                        </div>
                        <input type="checkbox" name="remember" id="remember">
                        <label for="remember" class="ui-checkbox ui-color col-green hover"></label>
                    </div>

                    <button type="submit" class="ui-button bg-blue hover ui-fnt medium size-2 col-wite ui-mt-5">
                        @lang('data.login')
                    </button>

                    {{ csrf_field() }}
                </form>

            </div>

        </div>

    </div>

@endsection