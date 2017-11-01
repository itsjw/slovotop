@extends('crm.layout.master')

@section('title')
    Settings
@endsection()

@section('HeadTitle')
    <div class="ui-fnt bold size-5 ui-color col-green">
        @lang('data.titleSettings')
    </div>
@endsection()

@section('content')

    <admin-setting v-cloak></admin-setting>

@endsection()