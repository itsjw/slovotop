@extends('crm.layout.master')

@section('title')
    @lang('data.titleReports') - {{ Auth::user()->name }}
@endsection()

@section('HeadTitle')
    @lang('data.titleReports')
@endsection()

@section('content')

    <admin-report></admin-report>

@endsection()