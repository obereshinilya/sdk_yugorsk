

@extends('web.layouts.app')
@section('title')
    Документарный блок
@endsection

@section('content')
    {{--    Включаем всплывашку с новым сообщением о событии--}}
    @include('web.admin.inc.new_JAS')

    @include('web.include.sidebar_doc')
    <div class="top_table">
        @include('web.include.toptable')
    </div>

    <div style="height: 66.3vh">

        <div class="row justify-content-center" style="height: 100%">
            <div class="col-md-12" style="height: 100%">
                <div class="card" style="height: 100%">
                    <div class="card-header">
                        <h2 class="text-muted" style="text-align: center" >Неопределенная таблица</h2>
                    </div>
                    <div class="inside_tab_padding form51" style="height:90%; padding-left: 0px">
                        <div style="background: #FFFFFF; border-radius: 6px" class="form51">
                            <table>
                                <thead>
                                <tr>
                                    <th>№</th>
                                    <th>Наименование ОПО</th>
                                    <th>Регистрационный номер ОПО</th>
                                    <th>Интегральный показатель ОПО</th>
                                    <th>Статус</th>
                                    <th>Дата отправки</th>
                                    <th>Время отправки</th>
                                    <th>Идентификатор отправки</th>
                                </tr>
                                </thead>
                                <tbody>
                                    @for($i=0; $i<50; $i++)
                                        <tr>
                                            <td>{{$i}}</td>
                                            <td>{{$i}}</td>
                                            <td>{{$i}}</td>
                                            <td>{{$i}}</td>
                                            <td>{{$i}}</td>
                                            <td>{{$i}}</td>
                                            <td>{{$i}}</td>
                                            <td>{{$i}}</td>
                                        </tr>
                                    @endfor

                                </tbody>
                            </table>
                        </div>
                     </div>
                 </div>
             </div>
        </div>
    </div>


@endsection
