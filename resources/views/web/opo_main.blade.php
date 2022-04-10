@extends('web.layouts.app')
@section('title')
    Паспорт ОПО
@endsection

@section('content')


@include('web.include.tb.sidebar_tb')


    <div class="top_table">
   @include('web.include.toptable')
    </div>
<div class="inside_content">
@include('web.include.numbs_line')
@include('web.include.opo.tabs_opo')

</div>

@endsection
@push('scripts')
    <script src="{{ asset('assets/js/tabs.js') }}" defer></script>
@endpush
