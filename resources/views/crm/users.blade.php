@extends('crm.layout.master')

@section('title')
    @lang('data.titleUser') - {{ Auth::user()->name }}
@endsection()

@section('HeadTitle')

    @lang('data.titleUser')

@endsection()

@section('content')

    <admin-users></admin-users>

@endsection()