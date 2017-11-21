@extends('crm.layout.master')

@section('title')
    @lang('data.titleHome') - {{ Auth::user()->name }}
@endsection
@section('HeadTitle')
    <div class="ui-fnt bold size-5 ui-color col-green">
        @lang('data.titleHome')
    </div>
@endsection()

@section('content')



@endsection()