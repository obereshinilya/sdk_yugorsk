<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="keywords" content="" />
<meta name="description" content="" />
<title>@yield('title')</title>
<meta property="og:title" content="" />
<meta property="og:image" content="assets/preview.jpg" />
<meta property="og:description" content=""/>
<link href="assets/favicon/favicon.ico" rel="shortcut icon" type="image/x-icon">
<link rel="stylesheet" href="assets/css/style.css">
<link rel="stylesheet" href="assets/fonts/fonts.css">
{{--    То, что было в старой шапке--}}
<link rel="stylesheet" href="{{ asset('assets/css/font-awesome.min.css') }}">
<script src="{{asset('/js/jquery.min.js')}}"></script>
@stack('am4-script-lib')
@stack('highcharts-script-lib')
@stack('datapicker')
@stack('calendar_scripts')
@stack('XMLSign')
@stack('app-css')
<script src="{{asset('tooltip/tooltip.js')}}"></script>
<link href="{{asset('tooltip/tooltip.css')}}" rel="stylesheet">
<script src="{{asset('modal-windows/modal_windows.js')}}"></script>
<link href="{{ asset('modal-windows/modal_windows.css') }}" rel="stylesheet">
