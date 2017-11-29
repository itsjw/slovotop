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
            user_id="{{ \Auth::id() }}"></admin-task-edit>

@endsection()

@push('scripts')
    <script src="{{ asset('edit/jodit.min.js') }}"></script>
    <link href="{{ asset('edit/jodit.min.css') }}" rel="stylesheet" type="text/css">
@endpush