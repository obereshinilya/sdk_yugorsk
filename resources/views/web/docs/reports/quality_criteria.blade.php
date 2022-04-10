

@extends('web.layouts.app')
@section('title')
    Справка о выполнении актов
@endsection

@section('content')
    @include('web.include.sidebar_doc')
    <div class="container">

        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header"><h2 class="text-muted" style="text-align: center" >Справка о выполнении актов, предписаний, выданных службой, отделом промышленной безопасности, работником, ответственным за промышленную безопасность<br>В период с {{date("Y-m-d", strtotime($start))}} по {{"$finish"}}</h2>
                        @can('product-create')
                            <div class="bat_info"><a href="{{ url('pdf_quality_criteria/'.date("Y-m-d", strtotime($start)).'/'.$finish) }}">Создать PDF</a></div>
                        @endcan
                    </div>

                    <div class="inside_tab_padding form51">
                        <div style="background: #FFFFFF; border-radius: 6px" class="row_block form51">

                    <table>
                        <tr>
                            <td colspan="2" rowspan="2">Критерий оценки<br></td>
                            <td colspan="10">Количество нарушений по критериям</td>
                        </tr>
                        <tr>
                            @for($i=1; $i<count($data['name_opo'])+1; $i++)
                            <td>{{$data['name_opo'][$i]}}</td>
                            @endfor
                            <td>Итого</td>
                        </tr>
                        <tr>
                            <td rowspan="3" >Критерий №1<br>Тяжесть возможных последствий </td>
                            <td class="centered">Красная зона</td>
                            @for($i=1; $i<count($data['k1_red'])+1; $i++)
                                <td style="text-align: center">{{$data['k1_red'][$i]}}</td>
                            @endfor
                            <td style="text-align: center">{{$sum['red']}}</td>
                        </tr>
                        <tr>
                            <td>Желтая зона</td>
                            @for($i=1; $i<count($data['k1_red'])+1; $i++)
                                <td style="text-align: center">{{$data['k1_yellow'][$i]}}</td>
                            @endfor
                            <td style="text-align: center">{{$sum['yellow']}}</td>
                        </tr>
                        <tr>
                            <td>Зеленая зона</td>
                            @for($i=1; $i<count($data['k1_red'])+1; $i++)
                                <td style="text-align: center">{{$data['k1_green'][$i]}}</td>
                            @endfor
                            <td style="text-align: center">{{$sum['green']}}</td>
                        </tr>
                        <tr>
                            <td rowspan="3">Критерий №2 <br> Способ устранения несоответствий</td>
                            <td class="centered">Собственными силами</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>Текущий ремонт</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>Капитальный ремонт</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td rowspan="6">Критерий №3 <br> Причины возникновения несоответствий</td>
                            <td class="centered">Подготовка персонала</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>Производственная дисциплина</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>Деградационный фактор</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>Эксплуатационный фактор</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>Производственный фактор</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>Низкое качество ремонтных работ</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                    </table>
{{--                    <tbody>--}}
{{--                    @foreach ($rows as $item)--}}
{{--                        <tr>--}}
{{--                            <td></td>--}}
{{--                            <td></td>--}}
{{--                            <td></td>--}}
{{--                            <td></td>--}}
{{--                            <td></td>--}}
{{--                            <td></td>--}}
{{--                            <td></td>--}}
{{--                        </tr>--}}

{{--                    @endforeach--}}


{{--                    </tbody>--}}

{{--                </table>--}}


            </div>
        </div>





@endsection
