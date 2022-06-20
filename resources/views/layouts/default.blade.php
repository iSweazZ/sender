<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'Laravel') }} - {{ucfirst($title ?? '')}}</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    @yield('customHead')
</head>
<body class="bg-zinc-900 overflow-x-hidden ">
    @if ($title == 'Accueil')
    <!-- <h1 id="appTitleDashboard" class="text-transparent customTextSize3vw text-center bg-clip-text z-50 bg-gradient-to-tr from-violet-900 to-rose-600 font-bold">{{config('app.name', 'Laravel')}} - {{ucfirst($title ?? '')}}</h1> -->
    <h1 id="appTitleDashboard" class="text-rose-600 customTextSize3vw text-center font-bold mt-2">{{config('app.name', 'Laravel')}} - {{ucfirst($title ?? '')}}</h1>
    @else
    <h1 id="appTitleDashboard" class="text-white customTextSize3vw text-center font-bold mt-2" >{{config('app.name', 'Laravel')}} - {{ucfirst($title ?? '')}}</h1>
        
    @endif
    @yield('content')
</body>
</html>