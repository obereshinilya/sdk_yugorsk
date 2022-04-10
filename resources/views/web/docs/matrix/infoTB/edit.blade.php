@extends('web.layouts.app')
@section('title')
    Редактирование
@endsection

@section('content')
    @push('app-css')
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    @endpush

    @include('web.include.sidebar_doc')


    <div class="top_table">
        @include('web.include.toptable')
    </div>

{{--    <div class="inside_content">--}}

{{--        <div style="background: #f8f9fa">--}}
{{--            <div class="card-header" style="width: 1242px"><h2 class="text-muted" style="text-align: center" >Редактирование информации о ТБ</h2></div>--}}
{{--        </div>--}}
{{--        <div class="inside_tab_padding" style="margin-right: 20px; width: 1250px; height: 515px">--}}

{{--            <div style="border-radius: 6px; width: 1210px" class="row_block form51">--}}
    <div class="inside_content">
        <div class="inside_tab_padding">
            <div class="row_block">
                <div style="background: #FFFFFF; height:62rem; padding: 35px; border-radius: 6px" class="container">
                    <div class="card-header"><h2 class="text-muted" style="text-align: center" >Редактирование информации о ТБ</h2></div>
                {!! Form::model($data, ['method' => 'POST','route' => ['update_TB', $data->idOTO], 'enctype'=>'multipart/form-data']) !!}


                <div class="card-header">
                    <div class="row justify-content-start">
                        <div class="col">
                            <h4 class="text-muted" style="text-align: left">Номер</h4>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                {!! Form::text('idOTO', null, array('placeholder' => 'Укажите номер ТБ','style' => 'height: 3vh; width: 70%', 'autocomplete'=>"off", 'class'=>'form-control')) !!}
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-header">
                    <div class="row justify-content-start">
                        <div class="col">
                            <h4 class="text-muted" style="text-align: left">Тип элемента ОПО</h4>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <select class="form-control" name="typeObj" id="selct_per5" style="width: 425px">
                                    @foreach($data_all as $row)
                                        @if ($data->typeObj==$row->type_id)
                                            <option selected="selected" value={{$row->type_id}}>{{$row->type_name}}</option>
                                        @else
                                            <option value={{$row->type_id}}>{{$row->type_name}}</option>
                                        @endif
                                    @endforeach
                                        @if($data->typeObj=="")
                                            <option selected="selected" value={{""}}>{{"Другое"}}</option>
                                        @endif
                                </select>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-header">
                    <div class="row justify-content-start">
                        <div class="col">
                            <h4 class="text-muted" style="text-align: left">Наименование ТБ</h4>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                {!! Form::text('descOTO', null, array('placeholder' => 'Укажите наименование ТБ','style' => 'height: 3vh; width: 70%', 'autocomplete'=>"off", 'class'=>'form-control')) !!}
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-header">
                    <div class="row justify-content-start">
                        <div class="col">
                            <h4 class="text-muted" style="text-align: left">№ опросного листа АПК</h4>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                {!! Form::text('typeQuest', null, array('placeholder' => 'Укажите № опросного листа АПК','style' => 'height: 3vh; width: 70%', 'autocomplete'=>"off", 'class'=>'form-control')) !!}
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-header">
                    <div class="row justify-content-start">
                        <div class="col" style="width: 250px">
                            <h4 class="text-muted" style="text-align: left; margin-top: 200px">При необходимости <br>выберите новое изображение</h4>
                            <input type="file" name="image" style="margin: 60px">
                        </div>

                        <div class="col">
                            <img alt="" src="{{asset('storage/'.$data->image)}}" class="replace" style="width: 750px; height: 500px">
                        </div>

                    </div>
                </div>


{{--                еще одна версия (без отображения текущего) ниже--}}
{{--                <div class="card-header">--}}
{{--                    <div class="row justify-content-start">--}}
{{--                        <div class="col">--}}
{{--                            <h4 class="text-muted" style="text-align: left">Новое изображение ТБ (при необходимости)</h4>--}}
{{--                        </div>--}}
{{--                        --}}
{{--                        <div class="col">--}}
{{--                            <input type="file" name="image">--}}
{{--                        </div>--}}

{{--                    </div>--}}
{{--                </div>--}}

                <div style="padding-bottom: 40px; margin-top: 20px"
                     class="text-center">
                    <button type="submit" class="btn btn-outline-success">Сохранить
                    </button>
                    <a href={{"/docs/infoTB"}}>
                        <button type="button" class="btn btn-outline-dark">Отменить
                        </button>
                    </a>
                </div>

            {!! Form::close() !!}

            </div>
        </div>

    </div>
    </div>


    @include('web.include.modal.datapicker')
@endsection
