<!doctype html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="description" content="@yield('meta-description')">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}">
    <style>
        {!! file_get_contents(asset('css/app.css')) !!}
    </style>

    <title>@yield('title')</title>

    <meta name="robots" content="@yield('index')"/>
    <meta name="robots" content="@yield('follow')"/>

    <meta property="og:title" content="@yield('title')">
    <meta property="og:description" content="@yield('meta-description')">
    <meta property="og:image" content="@yield('meta-image')">
    <meta property="og:type" content="@yield('meta-type')">
    <meta property="og:url" content="@yield('meta-url')">

    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:site" content="@SlovoTop">
    <meta name="twitter:creator" content="@SlovoTop">
    <meta name="twitter:title" content="@yield('title')">
    <meta name="twitter:description" content="@yield('meta-description')">
    <meta name="twitter:image" content="@yield('meta-image')">

</head>
<body>

<div id="app">
    @yield('wrap')
</div>

@yield('script')

<script>
    window.trans = <?php
    $lang_files = File::files(resource_path().'/lang/'.App::getLocale());
    $trans = [];
    foreach( $lang_files as $f ) {
        $filename         = pathinfo($f)['filename'];
        $trans[$filename] = trans($filename);
    }
    echo json_encode($trans);
    ?>;
</script>

<script>
    {!! file_get_contents(asset('js/app.js')); !!}
</script>



</body>
</html>