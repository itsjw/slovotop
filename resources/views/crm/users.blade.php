@extends('crm.layout.master')

@section('title')
    @lang('data.titleUser') - {{ Auth::user()->name }}
@endsection()

@section('HeadTitle')
    <div class="ui-fnt bold size-5 ui-color col-green">
        @lang('data.titleUser')
    </div>
@endsection()

@section('content')

    <admin-users v-cloak></admin-users>

@endsection()