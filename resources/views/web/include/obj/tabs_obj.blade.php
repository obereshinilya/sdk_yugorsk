<div class="opo_grid">
    <div class="opo_left">
        <div class="opo_block">


            <div class="tabs opo_tabs">

                <div class="tab two_col_tab">
                    <input type="radio" id="main_opo" name="tab_group" checked>
                    <label for="main_opo" class="tab_title">Основные сведения по элементу ОПО</label>
                    <section class="tab_content">
                        <div class="inside_tab_padding">
                            <div class="tech_passport_tab">

{{--                                <a href="#"><img alt="" src="{{asset('assets/images/icons/edit.svg')}}" class="edit_icon"></a>--}}

                                <table class="noborders">
                                    <thead>
                                    <tr>
                                        <th>Наименование элемента ОПО</th>
                                        <th>Статус</th>
                                        <th>Тип проекта</th>
                                        <th>Тип объекта</th>
                                        <th>Коэф. загруженности</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
{{--                                        {{$this_elem->elem_to_calc_40}}--}}
                                        <td>{{$this_elem->nameObj}}</td>
                                        <td class="good"><span>{{$this_elem->obj_to_status->desc_work}}</span></td>
                                        <td>Маннесманн</td>
                                        <td>{{$this_elem->obj_to_type->type_name}}</td>
                                        <td>0,56</td>
                                    </tr>
                                    </tbody>
                                </table>

                            </div>
                            <div class="bat_info"> <a href="/maintenance/{{$this_elem->idObj}}">Календарь технического обслуживания</a></div>

                        </div>
                    </section>

                </div>


                <div class="tab two_col_tab">
                    <input type="radio" id="opo_pass" name="tab_group">
                    <label for="opo_pass" class="tab_title">Функциональный паспорт элемента ОПО</label>
                    <section class="tab_content">
                        <div class="inside_tab_padding">
                            <div class="tech_passport_tab opo">
                                <h4>Перечень контролируемых технологичных параметров по объекту ОПО</h4>
                                <table>
                                    <thead>
                                    <tr>
                                        <th>АСУ ТП</th>
                                        <th>Наименование параметра</th>
                                        <th>Мин.</th>
                                        <th>Макс.</th>
                                        <th>Коэф-Нт</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($reglaments as $reglament)
                                    <tr>
                                        <td>{{$reglament->reglament_to_param->asutp_name}}</td>
                                        <td>{{$reglament->reglament_to_param->full_name}}</td>
                                        <td>{{$reglament->min}}</td>
                                        <td>{{$reglament->max}}</td>
                                        <td>{{$reglament->koef}}</td>
                                    </tr>
                                    @endforeach

                                    </tbody>

                                </table>
                                <div class="bat_info"> <a href="{{ route('pdf_tech_reg', $id_obj) }}" >Скачать</a></div>
                            </div>

                        </div>
                    </section>
                </div>

            </div>

        </div>

        <div class="period_block opo_period">

            <div class="func_passport_bottom" style="width: auto; height: 19vh">
                <h4 style="margin-top: 10px">Перечень несоответствий производственного контроля</h4>
                <div class="ppr_date_single" style="margin-top: 10px">Всего несоответствий <span>{{$this_elem->elem_to_APK->count()}}</span></div>
                <table>
                    <thead>
                    <tr>
                        <th>Несоответствия</th>
                        <th>Документ</th>
                        <th>Срок устранения</th>
                        <th>Коэф-нт</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($this_elem_apk as $apk)
                    <tr>
                        <td>{{$apk->Details}}</td>
                        <td>{{$apk->Document}} </td>
                        <td>{{$apk->CompleteDate}}</td>
                        <td>{{$apk->Weight}}</td>
                    </tr>
                    @endforeach
                    </tbody>
                </table>

            </div>



        </div>
    </div>

    <div class="opo_right">
        <div class="opo_squares">
            <div class="opo_page_square" id = "1">

                    <style>
                        #chartdiv, #chartdiv1, #chartdiv2, #chartdiv3 {
                            width: 100%;
                            height: 150px;
                            margin-top: -10px;
                        }
                    </style>
                    <div id="chartdiv"></div>
                    @include('charts.elem_main_charts.chart_1')
                <p style="margin-top: -23px">Интегральный показатель
                    <br/>состояния ПБ элемента ОПО
                </p>
            </div>
            <div class="opo_page_square" id = "2"><a href="#">
                    <div id="chartdiv1"></div>
                    @include('charts.elem_main_charts.chart_2')
                    <p style="margin-top: -23px"> Обобщенный показатель <br/>по комплексным сценариям</p></a></div>
            <div class="opo_page_square" id = "3"><a href="#">
                <div id="chartdiv2"></div>
                @include('charts.elem_main_charts.chart_3')
                    <p style="margin-top: -23px">Обобщенный показатель
                        <br/>превышения пределов безопасности
                        <br/>технологического процесса
                    </p></a></div>
            <div class="opo_page_square" id = "4"><a href="#">
                    <div id="chartdiv3"></div>
                    @include('charts.elem_main_charts.chart_4')
                    <p style="margin-top: -23px"> Обобщенный показатель
                        <br/>технического риска ПБ (состояния
                        <br/>и обслуживания) элемента ОПО
                    </p></a></div>
        </div>

        <div class="period_info inside_type">
            @include('charts.elem_main_charts.chart_elem_all')
        </div>
    </div>


    @include('web.include.script-lib.am4')
    @include('web.include.script-lib.highcharts')


</div>
@if($text['chart_1'] != '')
    <div id="chart_1_content">
        <h5>{{$text['chart_1']}}</h5>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var tooltip_Chart_1 = document.getElementById('chart_1_content');
            var Char1 = new Tooltip(tooltip_Chart_1, 'chart_1_id', 'chartdiv');
        })
    </script>
@endif
@if($text['chart_2'] != [])
    <div id="chart_2_content">
        <h5>
            @foreach($text['chart_2'] as $row)
                {{$row}}<br>
            @endforeach
        </h5>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var tooltip_Chart_2 = document.getElementById('chart_2_content');
            var Char2 = new Tooltip(tooltip_Chart_2, 'chart_2_id', 'chartdiv1');
        })
    </script>
@endif
@if($text['chart_3'] != [])
    <div id="chart_3_content">
            <table>
                <thead>
                <tr>
                    <th>Наименование сигнала</th>
                    <th style="text-align: center">Минимальное</th>
                    <th style="text-align: center">Максимальное</th>
                    <th style="text-align: center">Текущее значение</th>
                </tr>
                </thead>
                <tbody>
                <?php
                    if (count($text['chart_3']['name']) > 7){
                        $num_row = 7;
                    }    else{
                        $num_row = count($text['chart_3']['name']);
                    }
                ?>
                @for($i=0; $i<$num_row; $i++)
                    <tr>
                        <td>{{$text['chart_3']['name'][$i]}}</td>
                        <td style="text-align: center">{{$text['chart_3']['min'][$i]}}</td>
                        <td style="text-align: center">{{$text['chart_3']['max'][$i]}}</td>
                        <td style="text-align: center">{{$text['chart_3']['tek'][$i]}}</td>
                    </tr>
                @endfor
                </tbody>
            </table>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var tooltip_Chart_3 = document.getElementById('chart_3_content');
            var Char3 = new Tooltip(tooltip_Chart_3, 'chart_3_id', 'chartdiv2');
        })
    </script>
@endif
@if($text['chart_4'] != '')
    <div id="chart_4_content">
        <h5>{{$text['chart_4']}}</h5>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var tooltip_Chart_4 = document.getElementById('chart_4_content');
            var Char4 = new Tooltip(tooltip_Chart_4, 'chart_4_id', 'chartdiv3');
        })
    </script>
@endif

<script>
    $(document).ready(function (){
        function updateParams(){
            $.ajax({
                url:'/get_charts_vals/{{$id_obj}}',
                type:'GET',
                success:function(data){
                    // console.log(chart1)
                    var charts=[{'chart':[chart1, chart1yearLabel, chart1series2], 'data':parseFloat(data['ip_elem'])},
                        {'chart':[chart2, chart2yearLabel, chart2series2], 'data':parseFloat(data['op_m'])},
                        {'chart':[chart3, chart3yearLabel, chart3series2], 'data':parseFloat(data['op_r'])},
                        {'chart':[chart4, chart4yearLabel, chart4series2], 'data':parseFloat(data['op_el'])}]

                    var valuesOfCharts={'chart1':parseFloat(data['ip_elem']),
                        'chart2':parseFloat(data['op_m']),
                        'chart3':parseFloat(data['op_r']),
                        'chart4':parseFloat(data['op_el'])};

                    function updateChart(chart){
                        data=chart['data']
                        chart['chart'][0].data[0]['value']=data;
                        chart['chart'][1].text = `[bold]${data}[/]`;
                        chart['chart'][2].columns.template.fill = am4core.color("rgba(234,87,87,0.5)");

                        if (data >= 0.8) {
                            chart['chart'][2].columns.template.fill = am4core.color("rgba(105,175,112,0.5)");
                        }
                        if ((data >= 0.5) && (data < 0.8)) {
                            chart['chart'][2].columns.template.fill = am4core.color("rgba(255,225,73,0.47)");
                        }
                        if ((data >= 0.2) && (data < 0.5)) {
                            chart['chart'][2].columns.template.fill = am4core.color("rgb(242,177,64)");
                        }
                        if ((data >= 0.0) && (data < 0.2))
                            chart['chart'][2].columns.template.fill = am4core.color("rgba(234,87,87,0.5)");

                        chart['chart'][0].invalidateData();
                    }

                    for (var ch of charts){
                        // console.log(ch['data'])
                        updateChart(ch);
                    }
                }
            })
        }

        updateParams();
        setInterval(updateParams, 60000);

    })
</script>
{{--<script>--}}
{{--    document.addEventListener('DOMContentLoaded', function (){--}}
{{--        var tooltip_Chart_1=document.getElementById('chart_1_content');--}}
{{--        var Char1=new Tooltip(tooltip_Chart_1, 'chart_1_id', 'chartdiv');--}}
{{--        var tooltip_Chart_2=document.getElementById('chart_2_content');--}}
{{--        var Char2=new Tooltip(tooltip_Chart_2, 'chart_2_id', 'chartdiv1');--}}
{{--        var tooltip_Chart_3=document.getElementById('chart_3_content');--}}
{{--        var Char3=new Tooltip(tooltip_Chart_3, 'chart_3_id', 'chartdiv2');--}}
{{--        --}}
{{--    })--}}

{{--</script>--}}
