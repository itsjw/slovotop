@extends('site.index')

@section('content')

    <div class="section">
        <div class="container">

            <div class="column is-4 is-offset-4">

                <form method="post" action="{{ route('auth') }}">

                    <div class="field">
                        <label class="label">@lang('data.userEmail')</label>
                        <div class="control has-icons-left">
                            <input class="input" type="email" name="email" placeholder="@lang('data.userEmail')">
                            <span class="icon is-small is-left">
                            <i class="fa fa-envelope"></i>
                        </span>
                        </div>
                    </div>

                    <div class="field">
                        <label class="label">@lang('data.userPassword')</label>
                        <div class="control has-icons-left">
                            <input class="input" type="password" name="password" placeholder="@lang('data.userPassword')">
                            <span class="icon is-small is-left">
                            <i class="fa fa-key"></i>
                        </span>
                        </div>
                    </div>

                    <div class="field">
                        <label class="checkbox">
                            <input type="checkbox" name="remember">
                            @lang('data.userRemember')
                        </label>
                    </div>

                    {{ csrf_field() }}

                    <button type="submit" class="button is-primary">
                        @lang('data.login')
                    </button>
                </form>


            </div>

        </div>
    </div>

@endsection