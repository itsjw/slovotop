@extends('crm.layout.master')

@section('title')
    @lang('data.titleDoc') - {{ Auth::user()->name }}
@endsection()

@section('HeadTitle')
    <div class="ui-fnt bold size-5 ui-color col-green">
        @lang('data.titleDoc')
    </div>
@endsection()

@section('content')

    <admin-doc-edit
            doc_id="{{ $doc->id ?? 0 }}"
            user_id="{{ \Auth::id() }}"
            v-cloak>
    </admin-doc-edit>

@endsection()

@push('scripts')
    <script src="{{ asset('edit/jodit.min.js') }}"></script>
    <link href="{{ asset('edit/jodit.min.css') }}" rel="stylesheet" type="text/css">
@endpush