@extends('admin.layout.master')

@section('title')
    Home
@endsection

@section('content')

    <div class="ui-grid-block">

        <div class="ui-grid-4">
            <div class="ui-bg bg-wite ui-m-2">
                <div class="ui-color col-grey ui-p-2 ui-mr-2 ui-ml-2 admin-title-block">
                    <div class="ui-grid-block">
                        <div class="ui-grid-6 ui-fnt medium size-2">
                            @lang('data.users')
                        </div>
                        <div class="ui-grid-6 right ui-fnt regular size-1">
                            Всего
                        </div>
                    </div>
                </div>
                <div class="ui-p-2">
                    data
                </div>
            </div>
        </div>
        <div class="ui-grid-4">
            <div class="ui-bg bg-wite ui-m-2">
                <div class="ui-color col-grey ui-p-2 ui-mr-2 ui-ml-2 admin-title-block">
                    <div class="ui-grid-block">
                        <div class="ui-grid-6 ui-fnt medium size-2">
                            @lang('data.projects')
                        </div>
                        <div class="ui-grid-6 right ui-fnt regular size-1">
                            Всего
                        </div>
                    </div>
                </div>
                <div class="ui-p-2">
                    data
                </div>
            </div>
        </div>
        <div class="ui-grid-4">
            <div class="ui-bg bg-wite ui-m-2">
                <div class="ui-color col-grey ui-p-2 ui-mr-2 ui-ml-2 admin-title-block">
                    <div class="ui-grid-block">
                        <div class="ui-grid-6 ui-fnt medium size-2">
                            @lang('data.tasks')
                        </div>
                        <div class="ui-grid-6 right ui-fnt regular size-1">
                            Всего
                        </div>
                    </div>
                </div>
                <div class="ui-p-2">
                    data
                </div>
            </div>
        </div>

    </div>

@endsection()