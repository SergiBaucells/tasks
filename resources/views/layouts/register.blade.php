<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="theme-color" content="#F7C948"/>
    <meta name="apple-mobile-web-app-status-bar-style" content="#F7C948">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-title" content="Tasques Sergi Baucells">
    <link rel="apple-touch-startup-image" href="img/images/icons2/apple-touch-icon.png">
    <link rel="apple-touch-icon" sizes="57x57" href="img/images/icons2/apple-touch-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="60x60" href="img/images/icons2/apple-touch-icon-60x60.png">
    <link rel="apple-touch-icon" sizes="72x72" href="img/images/icons2/apple-touch-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="76x76" href="img/images/icons2/apple-touch-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="114x114" href="img/images/icons2/apple-touch-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="120x120" href="img/images/icons2/apple-touch-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="144x144" href="img/images/icons2/apple-touch-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="152x152" href="img/images/icons2/apple-touch-icon-152x152.png">
    <link rel="apple-touch-icon" sizes="180x180" href="img/images/icons2/apple-touch-icon-180x180.png">
    <link rel="manifest" href="/manifest.json">
    <link rel="apple-touch-icon" sizes="180x180" href="img/images/icons2/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="img/images/icons2/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="img/images/icons2/favicon-16x16.png">
    <link rel="mask-icon" href="img/images/icons2/safari-pinned-tab.svg" color="#d0c300">
    <meta name="msapplication-TileColor" content="#ffc40d">
    <meta name="msapplication-TileImage" content="img/images/icons2/mstile-144x144.png">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Carta compartida -->
    <meta property="og:image" content="/img/catalunya.png">
    <meta property="og:image:width" content="1190">
    <meta property="og:image:height" content="623">
    <meta property="og:description" content="Aplicaci&oacute; de tasques catalanes">
    <meta property="og:title" content="Tasques - Sergi Baucells Rordiguez">
    <meta property="og:url" content="https://tasks.sergibaucells.scool.cat">
    <meta property="og:type" content="website">
    <title>@yield('title')</title>
    <style>
        [v-cloak] {
            display: none
        }
    </style>
</head>
<body>
<div id="app" v-cloak>
    <v-app>
        @yield('content')
    </v-app>
</div>
<script src="{{mix('js/app.js')}}"></script>
</body>
</html>