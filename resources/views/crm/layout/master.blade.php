<!doctype html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}">
    <style>
        {!! file_get_contents(asset('css/app.css')) !!}
    </style>
    <title>CRM SlovoNet - @yield('title')</title>
</head>
<body>
<div id="app">

    @include('crm.head.head')

    @include('crm.menu.menu')

    @yield('content')

</div>

@yield('script')

<script>
    window.trans = <?php
    $lang_files = File::files(resource_path() . '/lang/' . App::getLocale());
    $trans = [];
    foreach ($lang_files as $f) {
        $filename = pathinfo($f)['filename'];
        $trans[$filename] = trans($filename);
    }
    echo json_encode($trans);
    ?>;

    window.ACCESS = @json(\App\Models\Menu::getAccessMenu());
    window.ROLE = @json(\Auth::user()->getRoles());
    window.ID = @json(\Auth::user()->id);
</script>

@stack('scripts')

<script>
    {!! file_get_contents(asset('js/app.js')); !!}
</script>

</body>
</html>