@extends('admin.layout.master')

@section('title')
    Projects
@endsection()

@section('HeadTitle')
    <div class="ui-fnt bold size-5 ui-color col-green">
        @lang('data.titleProject')
    </div>
@endsection()

@section('content')

    <admin-projects></admin-projects>

@endsection()