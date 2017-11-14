@extends('crm.layout.master')

@section('title')
    @lang('data.titleReports') - {{ Auth::user()->name }}
@endsection()

@section('HeadTitle')
    <div class="ui-fnt bold size-5 ui-color col-green">
        @lang('data.titleReports')
    </div>
@endsection()

@section('content')



@endsection()