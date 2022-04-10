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
    <div class="doc_header norm_header">
        <table>
            <tbody>
            <tr>
                <td>Перечень нормативной документации</td>
                <td><img alt="" src="{{asset('assets/images/icons/search.svg')}}"></td>
                <td><input type="text" id="" placeholder=""></td>
                <td>
                             <a>Добавить новый <img alt="" src="{{asset('assets/images/icons/upload.svg')}}"> </a>
                </td>
            </tr>
            </tbody>
        </table>
    </div>
    @include('upload-form')
</div>

@endsection
