@extends('web.layouts.app')
@section('title')
    Справка
@endsection

@section('content')


@include('web.include.sidebar_doc')


    <div class="top_table">
  @include('web.include.toptable')
    </div>

<div class="inside_content">
    <object width="1300" height="600" type="application/pdf" data="{{asset($image.'?#zoom=100&scrollbar=1&toolbar=1&navpanes=1')}}">
        <p>Insert your error message here, if the PDF cannot be displayed.</p>
    </object>
</div>

@endsection
