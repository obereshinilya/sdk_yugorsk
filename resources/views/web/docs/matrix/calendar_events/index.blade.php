@extends('web.layouts.app')
@section('title')
    Справочник событий
@endsection

@section('content')


@include('web.include.sidebar_doc')


    <div class="top_table">
  @include('web.include.toptable')
    </div>
{{-- {{$data_ok}}--}}
<div class="inside_content">
    @livewire('calendar-type')
</div>

@endsection
