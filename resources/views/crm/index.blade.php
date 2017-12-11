@extends('crm.layout.master')

@section('title')
    @lang('data.titleHome') - {{ Auth::user()->name }}
@endsection

@section('HeadTitle')

    @lang('data.titleHome')

@endsection()

@section('content')



@endsection()