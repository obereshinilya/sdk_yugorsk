@extends('web.layouts.app')
@section('title')
    Технологический блок
@endsection

@section('content')
{{--    <script src="https://code.highcharts.com/highcharts.js"></script>--}}
{{--    <script type="text/javascript" src="/js/charts/chart_column_PK.js"></script>--}}
{{--    <script type="text/javascript" src="/js/charts/chart_column_event.js"></script>--}}

{{--@include('web.include.tb.sidebar_tb')--}}



{{--  @include('upload-form')--}}

{{--        @livewire('post.show')--}}

<div id="app" class="block_rate">
<data-picker :id_s='@json($name)'></data-picker>
{{--    <app-component :data='@json($data)'></app-component>--}}
{{--    @json($data)--}}
    {{$name}}
</div>
@include('web.include.script-lib.am4')
@include('web.include.script-lib.highcharts')

@endsection
