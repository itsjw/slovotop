@extends('crm.layout.master')

@section('title')
    @lang('data.titleDoc') - {{ Auth::user()->name }}
@endsection()

@section('HeadTitle')
    <div class="ui-fnt bold size-5 ui-color col-green">
        @lang('data.titleDoc')
    </div>
@endsection()

@section('content')

    <admin-docs v-cloak></admin-docs>

@endsection()