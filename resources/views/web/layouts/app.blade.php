<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title> @yield('title')</title>

    <meta property="og:title" content="" />
    <meta property="og:image" content="assets/preview.jpg" />
    <meta property="og:description" content=""/>

    <!-- Scripts -->
{{--    <script src="{{ asset('js/app.js') }}" defer></script>--}}
{{--    <script src="{{asset('/js/charts/highcharts.js')}}"></script>--}}
{{--    <script src="{{asset('/js/charts/highcharts-more.js')}}"></script>--}}
    <script src="{{asset('tooltip/tooltip.js')}}"></script>
    <link href="{{asset('tooltip/tooltip.css')}}" rel="stylesheet">
    <script src="{{asset('modal-windows/modal_windows.js')}}"></script>
    <link href="{{ asset('modal-windows/modal_windows.css') }}" rel="stylesheet">



    <script src="{{asset('/js/jquery.min.js')}}"></script>
    @stack('am4-script-lib')
    @stack('highcharts-script-lib')
    @stack('datapicker')
    @stack('calendar_scripts')
    @stack('XMLSign')

{{--    <script src="/js/hchart/highcharts.src.js"></script>--}}
{{--    <script src="/js/hchart/highcharts-more.js"></script>--}}
{{--    <script src="/js/hchart/solid-gauge.js"></script>--}}


    <!-- Fonts -->
{{--    <link rel="dns-prefetch" href="//fonts.gstatic.com">--}}
{{--    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">--}}
{{--    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/material-design-iconic-font/2.2.0/css/material-design-iconic-font.min.css">--}}

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('assets/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/fonts/fonts.css') }}">
    <link href="{{ asset('assets/favicon/favicon.ico') }}" rel="shortcut icon" type="image/x-icon">


    @stack('app-css')

{{--    <link href="{{ asset('css/app.css') }}" rel="stylesheet">--}}

</head>
<body>


<div class="side_menu">
    @include('web.include.side_menu')
</div>

<div class="header">
    @include('web.include.header')
</div>

<div class="content">



    @yield('content')



</div>

@include('web.include.modal.modal')

@livewireScripts
@stack('scripts')

</body>





{{--<script type="text/javascript" src="{{asset('/js/jquery.min.js')}}"></script>--}}
<script type="text/javascript" src="{{asset('/js/top_table.js')}}"></script>
</html>
