

@extends('web.layouts.app')
@section('title')
    Отчеты
@endsection

@section('content')
    @include('web.include.sidebar_doc')


    <div style="height: 75.3vh">

        <div class="row justify-content-center" style="height: 100%">
            <div class="col-md-12" style="height: 100%">
                <div class="card" style="height: 100%">
                    <div class="card-header">
                        <h2 class="text-muted" style="text-align: center" >Реестр актуальных деклараций промышленной безопасности
                            опасных производственных объектов
                        </h2>
                    </div>

                    <div class="inside_tab_padding form51" style="height:100%; padding-left: 0px">
                        <div style="background: #FFFFFF; border-radius: 6px" class="form51">
                            <table>
                                <thead>
                                <tr>
                                    <th>№ п/п</th>
                                    <th>Наименование ДПБ</th>
                                    <th>Составные части ДПБ</th>
                                    <th>Введена в действие уведомлением Ростехнадзора рег. №, дата</th>
                                    <th>Рег. № ДПБ в Ростехнадзоре</th>
                                    <th>Наименование ЗЭПБ</th>
                                    <th>Рег.№ ЗЭПБ в Ростехнадзоре,
                                        дата
                                    </th>
                                </tr>
                                </thead>
                                <tbody>
                                    @foreach($data_to_table as $row)
                                        <tr>
                                            <td>{{$row->id}}</td>
                                            <td>{{$row->name_DPB}}</td>
                                            <td>{{$row->parts_DPB}}</td>
                                            <td>{{$row->massage_rtn}}</td>
                                            <td>{{$row->reg_num_dpb}}</td>
                                            <td>{{$row->name_zepb}}</td>
                                            <td>{{$row->reg_num_date_zepb}}</td>
                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>
                        </div>
                     </div>
                 </div>
             </div>
        </div>
    </div>


@endsection
