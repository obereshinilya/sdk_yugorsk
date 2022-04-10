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
{{--        <div class="card-header" style="width: 1242px"><h2 class="text-muted" style="text-align: center" >Добавление информации о элементе ОПО</h2></div>--}}
{{--        </div>--}}
{{--        <div class="inside_tab_padding" style="margin-right: 20px; width: 1250px; height: 515px">--}}

{{--            <div style="border-radius: 6px; width: 1210px" class="row_block form51">--}}

    <div class="inside_content">
        <div class="inside_tab_padding">
            <div class="row_block">
                <div style="background: #FFFFFF; height:55rem; padding: 35px; border-radius: 6px"
                     class="container">
                    <div class="card-header"><h2 class="text-muted" style="text-align: center" >Добавление информации о элементе ОПО</h2></div>
                {!! Form::open(array('route' => 'store_Obj','method'=>'POST')) !!}

                <div class="card-header">
                    <div class="row justify-content-start">
                        <div class="col">
                            <h4 class="text-muted" style="text-align: left">Номер элемента ОПО</h4>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                {!! Form::text('idObj', null, array('placeholder' => 'Укажите номер элемента ОПО','style' => 'height: 3vh; width: 70%', 'autocomplete'=>"off", 'class'=>'form-control')) !!}
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-header">
                    <div class="row justify-content-start">
                        <div class="col">
                            <h4 class="text-muted" style="text-align: left">Наименование элемента ОПО</h4>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                {!! Form::text('nameObj', null, array('placeholder' => 'Укажите наименование элемента ОПО','style' => 'height: 3vh; width: 85%', 'autocomplete'=>"off", 'class'=>'form-control')) !!}
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-header">
                    <div class="row justify-content-start">
                        <div class="col">
                            <h4 class="text-muted" style="text-align: left">Принадлежит к УППГ № (указать при наличии)</h4>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                {!! Form::text('uppg', null, array('placeholder' => 'Укажите номер при наличии','style' => 'height: 3vh; width: 85%', 'autocomplete'=>"off", 'class'=>'form-control')) !!}
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-header">
                    <div class="row justify-content-start">

                        <div class="col">
                            <h4 class="text-muted" style="text-align: left">Состояние элемента ОПО</h4>
                        </div>
                        <div class="col">
                            {!! Form::select('InUse', array('1' => 'Используется', '0' => 'Не используется'), null, ['style' => 'width: 90%', 'class'=>'form-control']) !!}
                        </div>
                    </div>
                </div>

                <div class="card-header">
                    <div class="row justify-content-start">
                        <div class="col">
                            <h4 class="text-muted" style="text-align: left">Тип объекта</h4>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <select class="form-control" name="QP1_TYPE" id="selct_per5">
                                    @foreach($data_all as $row)
                                            <option value={{$row->id}}>{{$row->name}} </option>
                                    @endforeach
                                            <option value={{"0"}}>{{"Другое"}}
                                </select>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-header">
                    <div class="row justify-content-start">
                        <div class="col">
                            <h4 class="text-muted" style="text-align: left">Наименование ОПО</h4>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <select class="form-control" name="idOPO" id="selct_per2">
                                    @foreach($data_opo as $row)
                                            <option value={{$row->idOPO}}>{{$row->descOPO}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-header">
                    <div class="row justify-content-start">
                        <div class="col">
                            <h4 class="text-muted" style="text-align: left">Полное наименование элемента ОПО</h4>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                {!! Form::text('descObj', null, array('placeholder' => 'Укажите полное наименование элемента ОПО','style' => 'height: 3vh; width: 85%', 'autocomplete'=>"off", 'class'=>'form-control')) !!}
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
                                <select class="form-control" name="typeObj" id="selct_per3">
                                    @foreach($data_obj_type as $row)
                                     ption selected="selected" value={{$row->type_id}}>{{$row->type_name}}</option>
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
                            <h4 class="text-muted" style="text-align: left">Статус элемента ОПО</h4>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <select class="form-control" name="status" id="selct_per3">
                                    @foreach($data_status as $row)
                                            <option value={{$row->id_status}}>{{$row->desc_work}}</option>
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
                            <h4 class="text-muted" style="text-align: left">Тип проекта</h4>
                        </div>
                        <div class="col">
                            {!! Form::select('type_project', array('W1' => '1 очередь', 'W' => '2 очередь', '' => 'Нет данных'), null, ['style' => 'width: 90%', 'class'=>'form-control']) !!}
                        </div>
                    </div>
                </div>

                <div style="padding-bottom: 40px; margin-top: 20px"
                     class="text-center">
                    <button type="submit" class="btn btn-outline-success">Сохранить
                    </button>
                    <a href={{"/docs/infoObj"}}>
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
