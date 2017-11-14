@extends('crm.layout.master')

@section('title')
    @lang('data.titleRoles') - {{ Auth::user()->name }}
@endsection()

@section('HeadTitle')
    <div class="ui-fnt bold size-5 ui-color col-green">
        @lang('data.titleRoles')
    </div>
@endsection()

@section('content')

    <admin-roles v-cloak></admin-roles>

@endsection()