<!doctype html>
<html class="no-js" lang="ru">
<head>
    <title>Сентрас Коммеск Life – Компания по страхованию жизни</title>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="description"
          content="Финансовая защита от последствий несчастных случаев на работе. Программы пенсионного накопления и страхования жизни.">
    <link rel="alternate" type="application/rss+xml" title="" href="rss.xml"/>
    <meta name="viewport" content="width=device-width">
    <link rel="apple-touch-icon" href="">
{{--    <link rel="preload" href="/templates/assets/images/sprite.svg" as="image"/>--}}

    <link rel="apple-touch-icon" sizes="120x120" href="{{ asset('images/apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('images/logonew.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('images/logonew.png') }}">
    <link rel="manifest" href="{{ asset('images/site.webmanifest') }}">
    <link rel="mask-icon" href="{{ asset('images/safari-pinned-tab.svg') }}" color="#5bbad5">
    <meta name="msapplication-TileColor" content="#2b5797">
    <meta name="theme-color" content="#ffffff">
    <link href="https://fonts.googleapis.com/css?family=Alegreya+Sans&display=swap" rel="stylesheet">
    <script src="{{ asset('scripts/jquery.min.js@v=1531217620') }}"></script>
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-180583027-1"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.2/jquery.validate.min.js" integrity="sha512-UdIMMlVx0HEynClOIFSyOrPggomfhBKJE28LKl8yR3ghkgugPnG6iLfRfHwushZl1MOPSY6TsuBDGPK2X4zYKg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    {{--    Font awesome--}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('images/favicon-32x32.png') }}">

    <link rel="stylesheet" href="{{ asset('css/app.css?v=' . md5_file('css/app.css')) }}"/>
    <link rel="stylesheet" href="{{ asset('scripts/script.js?v=' . md5_file('scripts/script.js')) }}"/>

    <noscript>
        <div><img src="https://mc.yandex.ru/watch/68327698" style="position:absolute; left:-9999px;" alt=""/></div>
    </noscript>
</head>
<body>

@include('inc.header')
@yield('content')
@include('inc.footer')

<script src="{{ mix('js/app.js') }}"></script>

</body>
</html>

