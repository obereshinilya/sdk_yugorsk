

@extends('web.layouts.app')
@section('title')
    Отчет об эффективности
@endsection

@section('content')
    @include('web.include.sidebar_doc')
    <div class="container">

        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header"><h2 class="text-muted" style="text-align: center" >Отчет об эффективности производственного контроля за соблюдением требований промышленной безопасности по ОПО<br>
                            За {{$quarter}} квартал {{$year}} года</h2>
                        @can('product-create')
                            <div class="bat_info"><a href="{{ url('pdf_effect/'.$quarter.'/'.$year) }}">Создать PDF</a></div>
                        @endcan
                    </div>

                    <div class="inside_tab_padding form51">
                        <div style="background: #FFFFFF; border-radius: 6px; width: 120%" class="row_block form51">
                <table>
                    <thead>
                    <tr>
                        <th rowspan="2" class="centered">Наименование ОПО</th>
                        <th colspan="7" class="centered">Показатели безопасности функционирования ОПО</th>
                        <th rowspan="2" class="centered">Обобщенный показатель безопасности функционирования ОПО</th>
                        <th rowspan="2" class="centered">Показатель безаварийности ОПО</th>
                        <th rowspan="2" class="centered">Показатель готовности организации и персонала ОПО к локализации аварий и инцидентов</th>
                        <th rowspan="2" class="centered">Обобщенный показатель результативности АПК ОПО</th>
                    </tr>
                    <tr>
                        <th class="centered">Показатель наличия "критичных" несоответствий</th>
                        <th class="centered">Показатель устраняемости нарушений</th>
                        <th class="centered">Показатель результативности контрольных процедур ПК</th>
                        <th class="centered">Показатель наличия повторно выявляемых несоответствий</th>
                        <th class="centered">Показатель эффективности корректирующих и предупреждающих действий </th>
                        <th class="centered">Показатель результативности ПК, в сравнении с внешним производственным контролем</th>
                        <th class="centered">Показатель охвата элементов ОПО контрольными процедурами</th>
                    </tr>
                    </thead>
                    <tbody>
                    @for ($i=0; $i<count($data['name_opo']); $i++)
                        <tr>
                            <td>{{$data['name_opo'][$i]}}</td>
                            <td>{{$data['p_kr'][$i]}}</td>
                            <td>{{$data['p_un'][$i]}}</td>
                            <td>{{$data['p_kp'][$i]}}</td>
                            <td>{{$data['p_pn'][$i]}}</td>
                            <td>{{$data['p_kd'][$i]}}</td>
                            <td>{{$data['p_vp'][$i]}}</td>
                            <td>{{$data['p_ok'][$i]}}</td>
                            <td>{{$data['r_bf'][$i]}}</td>
                            <td>{{$data['r_ab'][$i]}}</td>
                            <td>{{$data['r_go'][$i]}}</td>
                            <td>{{$data['o_pk'][$i]}}</td>
                        </tr>

                    @endfor


                    </tbody>

                </table>


            </div>
        </div>





@endsection
