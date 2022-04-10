@extends('web.layouts.app')
@section('title')
    Добавление записи
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
{{--             <div class="card-header" style="width: 1242px"><h2 class="text-muted" style="text-align: center" >Добавление записи о ОПО</h2></div>--}}
{{--        </div>--}}
{{--        <div class="inside_tab_padding" style="margin-right: 20px; width: 1250px; height: 515px">--}}

{{--            <div style="border-radius: 6px; width: 1210px" class="row_block form51">--}}
    <div class="inside_content">
        <div class="inside_tab_padding">
            <div class="row_block">
                <div style="background: #FFFFFF; height:45rem; padding: 35px; border-radius: 6px"
                     class="container">
                    <div class="card-header"><h2 class="text-muted" style="text-align: center" >Добавление записи о ОПО</h2></div>
                {!! Form::open(array('route' => 'store_OPO','method'=>'POST')) !!}


                <div class="card-header">
                    <div class="row justify-content-start">
                        <div class="col">
                            <h4 class="text-muted" style="text-align: left">Наименование ОПО</h4>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                {!! Form::text('descOPO', null, array('placeholder' => 'Укажите наименование ОПО','style' => 'height: 3vh; width: 70%', 'autocomplete'=>"off", 'class'=>'form-control')) !!}
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-header">
                    <div class="row justify-content-start">
                        <div class="col">
                            <h4 class="text-muted" style="text-align: left">Регистрационный номер ОПО</h4>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                {!! Form::text('regNumOPO', null, array('placeholder' => 'Укажите регистрационный номер ОПО','style' => 'height: 3vh; width: 70%', 'autocomplete'=>"off", 'class'=>'form-control')) !!}
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-header">
                    <div class="row justify-content-start">
                        <div class="col">
                            <h4 class="text-muted" style="text-align: left">Дата регистрации</h4>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                {!! Form::date('dateReg', null, array('placeholder' => 'Укажите дату регистрации','style' => 'height: 3vh; width: 70%', 'autocomplete'=>"off", 'class'=>'form-control')) !!}
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-header">
                    <div class="row justify-content-start">
                        <div class="col">
                            <h4 class="text-muted" style="text-align: left">Класс опасности</h4>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                {!! Form::text('classHazard', null, array('placeholder' => 'Укажите класс опасности','style' => 'height: 3vh; width: 70%', 'autocomplete'=>"off", 'class'=>'form-control')) !!}
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-header">
                    <div class="row justify-content-start">
                        <div class="col">
                            <h4 class="text-muted" style="text-align: left">Полное наименование</h4>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                {!! Form::text('fullDescOPO', null, array('placeholder' => 'Укажите полное наименование','style' => 'height: 3vh; width: 70%', 'autocomplete'=>"off", 'class'=>'form-control')) !!}
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-header">
                    <div class="row justify-content-start">
                        <div class="col">
                            <h4 class="text-muted" style="text-align: left">Статус</h4>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                {!! Form::select('flDel', array('0' => 'В эксплуатации', '1' => 'Выведен из эксплуатации'), null, ['style' => 'width: 70%', 'class'=>'form-control']) !!}
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-header">
                    <div class="row justify-content-start">
                        <div class="col">
                            <h4 class="text-muted" style="text-align: left">Дата модернизации</h4>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                {!! Form::date('dateMode', null, array('placeholder' => 'Укажите дату модернизации','style' => 'height: 3vh; width: 70%', 'autocomplete'=>"off", 'class'=>'form-control')) !!}
                            </div>
                        </div>
                    </div>
                </div>



                <div style="padding-bottom: 40px; margin-top: 20px"
                     class="text-center">
                    <button type="submit" class="btn btn-outline-success">Сохранить
                    </button>
                    <a href={{"/docs/infoOPO"}}>
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
