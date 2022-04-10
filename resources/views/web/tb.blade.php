@extends('web.layouts.app')
@section('title')
    Технологический блок
@endsection

@section('content')

@include('web.include.tb.sidebar_tb')

    <div class="top_table">
   @include('web.include.toptable')

    </div>

    <div class="inside_content">
        @include('web.include.numbs_line')
        @include('web.include.tb.tabs_tb')

        @include('web.include.script-lib.am4')
        @include('web.include.script-lib.highcharts')
    </div>

@endsection
