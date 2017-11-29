@extends('crm.layout.master')

@section('title')
    @lang('data.titleSettings') - {{ Auth::user()->name }}
@endsection()

@section('HeadTitle')
    <div class="ui-fnt bold size-5 ui-color col-green">
        @lang('data.titleSettings')
    </div>
@endsection()

@section('content')

    <admin-setting></admin-setting>

@endsection()