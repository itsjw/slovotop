@extends('crm.layout.master')

@section('title')
    @lang('data.titleTasks') - {{ Auth::user()->name }}
@endsection()

@section('HeadTitle')
    <div class="ui-fnt bold size-5 ui-color col-green">
        @lang('data.titleTasks')
    </div>
@endsection()

@section('content')

    <admin-task-edit
            task_id="{{ $task->id ?? 0 }}"
            user_id="{{ \Auth::id() }}"
            v-cloak></admin-task-edit>

@endsection()