@extends('crm.layout.master')

@section('title')
    @lang('data.titleHome') - {{ Auth::user()->name }}
@endsection

@section('HeadTitle')

        <h1 class="title is-5">@lang('data.titleHome')</h1>

@endsection()

@section('content')



@endsection()