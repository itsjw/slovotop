@extends('crm.layout.master')

@section('title')
    @lang('data.titleSubjects') - {{ Auth::user()->name }}
@endsection()

@section('HeadTitle')
    <div class="ui-fnt bold size-5 ui-color col-green">
        @lang('data.titleSubjects')
    </div>
@endsection()

@section('content')

    <admin-subject user_id="{{ \Auth::id() }}"
                   v-cloak></admin-subject>

@endsection()