@extends('web.layouts.app')
@section('title')
    Создание
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
{{--            <div class="card-header" style="width: 1242px"><h2 class="text-muted" style="text-align: center" >Добавление информации о ТБ</h2></div>--}}
{{--        </div>--}}
{{--        <div class="inside_tab_padding" style="margin-right: 20px; width: 1250px; height: 515px">--}}

{{--            <div style="border-radius: 6px; width: 1210px" class="row_block form51">--}}

    <div class="inside_content">
        <div class="inside_tab_padding">
            <div class="row_block">
                <div style="background: #FFFFFF; height:33rem; padding: 35px; border-radius: 6px" class="container">
                    <div class="card-header"><h2 class="text-muted" style="text-align: center" >Добавление ТБ</h2></div>
                {!! Form::open(array('route' => 'store_TB','method'=>'POST', 'enctype'=>'multipart/form-data')) !!}


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
                                            <option value={{$row->type_id}}>{{$row->type_name}}</option>
                                    @endforeach
                                            <option value={{""}}>{{"Другое"}}
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

{{--                <div class="card-header">--}}
{{--                    <div class="row justify-content-start">--}}
{{--                        <div class="col">--}}
{{--                            <h4 class="text-muted" style="text-align: left">Путь к изображению</h4>--}}
{{--                        </div>--}}
{{--                        <div class="col">--}}
{{--                            <div class="form-group">--}}
{{--                                {!! Form::text('image', null, array('placeholder' => 'Укажите путь к изображению','style' => 'height: 3vh; width: 70%', 'autocomplete'=>"off", 'class'=>'form-control')) !!}--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}

                <div class="card-header">
                    <div class="row justify-content-start">
                        <div class="col">
                            <h4 class="text-muted" style="text-align: left">Загрузить изображение ТБ</h4>
                        </div>
                        <div class="col">
                            <input type="file" name="image">
                        </div>

                    </div>
                </div>



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
