@extends('crm.layout.master')

@section('title')
    @lang('data.titleProject') - {{ Auth::user()->name }}
@endsection()

@section('HeadTitle')
    @lang('data.titleProject')
@endsection()

@section('content')

    <admin-projects user_id="{{ \Auth::id() }}"></admin-projects>

@endsection()