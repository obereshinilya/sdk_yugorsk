{{--@extends('web.layouts.app')--}}
{{--@section('title')--}}
{{--    Главная страница ОПО--}}
{{--@endsection--}}

{{--@section('content')--}}


    @push('datapicker')
    <link rel="stylesheet" href="{{asset('js/jquery/jquery-ui.css')}}">
    <script src="{{asset('js/jquery/jquery1.12.4.js')}}"></script>
    <script src="{{asset('js/jquery/jquery-ui.js')}}"></script>
    @endpush

<script src="<?php echo e(asset('/calendarEvents/datetimepicker/moment-with-locales.min.js')); ?>"></script>

<script language="JavaScript">
    Highcharts.setOptions({
        lang: {
            loading: 'Загрузка...',
            months: ['Январь', 'Февраль', 'Март', 'Апрель', 'Май', 'Июнь', 'Июль', 'Август', 'Сентябрь', 'Октябрь', 'Ноябрь', 'Декабрь'],
            weekdays: ['Воскресенье', 'Понедельник', 'Вторник', 'Среда', 'Четверг', 'Пятница', 'Суббота'],
            shortMonths: ['Янв', 'Фев', 'Март', 'Апр', 'Май', 'Июнь', 'Июль', 'Авг', 'Сент', 'Окт', 'Нояб', 'Дек'],
            exportButtonTitle: "Экспорт",
            printButtonTitle: "Печать",
            rangeSelectorFrom: "С",
            rangeSelectorTo: "По",
            rangeSelectorZoom: "Период",
            downloadPNG: 'Скачать PNG',
            downloadJPEG: 'Скачать JPEG',
            downloadPDF: 'Скачать PDF',
            downloadSVG: 'Скачать SVG',
            printChart: 'Напечатать график'
        }
    });
    $(document).ready(function () {
        var ids = 1;

        var today = new Date();
        var dd = today.getDate();
        var mm = today.getMonth()+1; //January is 0!
        var yyyy = today.getFullYear();
        var hh = today.getHours();
        var min = today.getMinutes();
        if(hh<10) {  hh = '0'+dd }
        if(dd<10) {  dd = '0'+dd }
        if(mm<10) {  mm = '0'+mm }
        setInterval(() => {
            today = new Date();
            dd = today.getDate();
            mm = today.getMonth()+1; //January is 0!
            yyyy = today.getFullYear();
            hh = today.getHours();
            min = today.getMinutes();
        }, 6000);
        var _time = yyyy + '-' + mm + '-' + dd + ' ' + hh + ':' + min;
        setInterval(() => {
            _time = yyyy + '-' + mm + '-' + dd + ' ' + hh + ':' + min;
        }, 6000);
            var chart;
        var old_date;
        var options;
        var flag_ip = true;  // если True then IP_OPO and False then IP_OPO_PROact
        var path = '/charts/fetch-data/{{$id}}/data/'+_time;
        setInterval(() => {
            path = '/charts/fetch-data/{{$id}}/data/'+_time;
        }, 6000);
        var IP=document.getElementById('ip-opo')
        var IP_strelka=document.getElementById('ip-opo-small')
        var IP_tek=document.getElementById('ip-opo-small-now')
        var IP_hour=document.getElementById('ip-opo-small-hour')
        var IP_day=document.getElementById('ip-opo-small-day')
        var PRO=document.getElementById('ip-opo-pro')
        var PRO_strelka=document.getElementById('ip-opo-pro-small')
        var PRO_hour=document.getElementById('ip-opo-pro-small-hour')
        var PRO_day=document.getElementById('ip-opo-pro-small-day')
        var PRO_month=document.getElementById('ip-opo-pro-small-month')
        var text_legend="Текущий показатель";


        IP.style.backgroundColor="#FFE4C4"
        IP_strelka.style.backgroundColor="#FFE4C4"
        IP_tek.style.backgroundColor="#FFE4C4"
        IP_hour.style.backgroundColor=""
        IP_day.style.backgroundColor=""
        PRO.style.backgroundColor=""
        $.datepicker.regional['ru'] = {
            closeText: 'Закрыть',
            prevText: 'Предыдущий',
            nextText: 'Следующий',
            currentText: 'Сегодня',
            monthNames: ['Январь','Февраль','Март','Апрель','Май','Июнь','Июль','Август','Сентябрь','Октябрь','Ноябрь','Декабрь'],
            monthNamesShort: ['Янв','Фев','Мар','Апр','Май','Июн','Июл','Авг','Сен','Окт','Ноя','Дек'],
            dayNames: ['воскресенье','понедельник','вторник','среда','четверг','пятница','суббота'],
            dayNamesShort: ['вск','пнд','втр','срд','чтв','птн','сбт'],
            dayNamesMin: ['Вс','Пн','Вт','Ср','Чт','Пт','Сб'],
            weekHeader: 'Не',
            dateFormat: 'dd.mm.yy',
            firstDay: 1,
            isRTL: false,
            showMonthAfterYear: false,
            yearSuffix: ''
        };
        $.datepicker.setDefaults($.datepicker.regional['ru']);

        $( function() {
            var dateFormat = 'yyyy-mm-dd',
                from = $( "#from" )
                    .datepicker({
                        defaultDate: "+0D",
                        // changeMonth: true,
                        // numberOfMonths: 1,
                        dateFormat: "yy-mm-dd",
                        showButtonPanel: true,
                        maxDate: "+0D",
                        onSelect: function(dateText) {
                            var buffer= new Date(dateText)
                            buffer.setDate(buffer.getDate()+1)
                            _time=buffer.toISOString()
                            if (flag_ip){
                                IP.style.backgroundColor="#FFE4C4"
                                IP_strelka.style.backgroundColor="#FFE4C4"
                                IP_tek.style.backgroundColor="#FFE4C4"
                                IP_hour.style.backgroundColor=""
                                IP_day.style.backgroundColor=""
                                PRO.style.backgroundColor=""
                                text_legend="Текущий показатель"
                                path = '/charts/fetch-data/{{$id}}/data/'+_time;
                                var btns=document.getElementsByClassName('button 2')
                                for (var btn of btns){
                                    btn.type="button"
                                }
                                var btns_pro=document.getElementsByClassName('button 1')
                                for (var btn of btns_pro) {
                                    btn.type = "hidden"
                                }
                            }
                            else {
                                PRO.style.backgroundColor="#FFE4C4"
                                PRO_strelka.style.backgroundColor="#FFE4C4"
                                PRO_hour.style.backgroundColor="#FFE4C4"
                                PRO_day.style.backgroundColor=""
                                PRO_month.style.backgroundColor=""
                                IP.style.backgroundColor=""
                                text_legend="Часовой показатель"
                                path = '/charts/fetch-data-prognoz/{{$id}}/data/'+_time;
                                var btns=document.getElementsByClassName('button 2')
                                for (var btn of btns){
                                    btn.type="hidden"
                                }
                                var btns_pro=document.getElementsByClassName('button 1')
                                for (var btn of btns_pro) {
                                    btn.type = "button"
                                }
                            }
                            $.getJSON({
                                url: path,
                                method: 'GET',
                                success: function (data) {
                                    options.series[0].data = data;
                                    chart = new Highcharts.Chart(options);
                                    old_date = data[data.length-1][0];
                                    chart.series[0].color = colors_charts(data[data.length-1][1]);
                                    chart.series[0].redraw();
                                    chart.series[0].name=text_legend

                                }
                            });
                        }
                    })
                    .on( "change", function() {
                        to.datepicker( "option", "minDate", getDate( this ) );
                    }),
                to = $( "#to" ).datepicker({
                    defaultDate: "+1w",
                    changeMonth: true,
                    numberOfMonths: 1
                })
                    .on( "change", function() {
                        from.datepicker( "option", "maxDate", getDate( this ) );
                    });

            function getDate( element ) {
                var date;
                try {
                    date = $.datepicker.parseDate( dateFormat, element.value );

                } catch( error ) {
                    date = null;
                }

                return date;
            }
        } );
        function colors_charts(params) {
            if ((params<=1.00)&&(params>0.8)) {
                return "rgba(70,183,78,0.5)";
            }
            if ((params<=0.80)&&(params>0.5)) {
                return  "#fae6ae";

            }
            if ((params<=0.50)&&(params>0.2)) {
                return  "#f2b140";

            }
            if ((params<=0.20)&&(params>0.00)) {
                return  "rgba(234,87,87,0.5)";
            }
        }
            $("#ip-opo").click(function() {    //разберемся с интегральными показателями
                // действия, которые будут выполнены при наступлении события...
                IP.style.backgroundColor="#FFE4C4"
                IP_strelka.style.backgroundColor="#FFE4C4"
                IP_tek.style.backgroundColor="#FFE4C4"
                IP_hour.style.backgroundColor=""
                IP_day.style.backgroundColor=""
                PRO.style.backgroundColor=""
                text_legend="Текущий показатель"

                flag_ip = true;
                path = '/charts/fetch-data/{{$id}}/data/'+_time;
                var btns=document.getElementsByClassName('button 2')
                for (var btn of btns){
                    btn.type="button"
                }
                var btns_pro=document.getElementsByClassName('button 1')
                for (var btn of btns_pro) {
                    btn.type = "hidden"
                }
                $.getJSON({
                    url: path,
                    method: 'GET',
                    success: function (data) {
                        options.series[0].data = data;
                        chart = new Highcharts.Chart(options);
                        old_date = data[data.length-1][0];
                        chart.series[0].color = colors_charts(data[data.length-1][1]);
                        chart.series[0].redraw();
                        chart.series[0].name=text_legend

                    }
                });
            });
            $("#ip-opo-small-now").click(function() {
                IP.style.backgroundColor="#FFE4C4"
                IP_strelka.style.backgroundColor="#FFE4C4"
                IP_tek.style.backgroundColor="#FFE4C4"
                IP_hour.style.backgroundColor=""
                IP_day.style.backgroundColor=""
                PRO.style.backgroundColor=""
                flag_ip = true;
                text_legend="Текущий показатель"

                path = '/charts/fetch-data/{{$id}}/data/'+_time;
                $.getJSON({
                    url: path,
                    method: 'GET',
                    success: function (data) {
                        options.series[0].data = data;
                        chart = new Highcharts.Chart(options);
                        old_date = data[data.length-1][0];
                        chart.series[0].color = colors_charts(data[data.length-1][1]);
                        chart.series[0].redraw();
                        chart.series[0].name=text_legend

                    }
                });
            });
            $("#ip-opo-small-hour").click(function() {
                IP.style.backgroundColor="#FFE4C4"
                IP_strelka.style.backgroundColor="#FFE4C4"
                IP_tek.style.backgroundColor=""
                IP_hour.style.backgroundColor="#FFE4C4"
                IP_day.style.backgroundColor=""
                PRO.style.backgroundColor=""
                flag_ip = true;
                text_legend="Часовой показатель";
                path = '/charts/fetch-data-hour/{{$id}}/data/'+_time;
                $.getJSON({
                    url: path,
                    method: 'GET',
                    success: function (data) {
                        options.series[0].data = data;
                        chart = new Highcharts.Chart(options);
                        old_date = data[data.length-1][0];
                        chart.series[0].color = colors_charts(data[data.length-1][1]);
                        chart.series[0].redraw();
                        chart.series[0].name=text_legend

                    }
                });
            });
            $("#ip-opo-small-day").click(function() {
                IP.style.backgroundColor="#FFE4C4"
                IP_strelka.style.backgroundColor="#FFE4C4"
                IP_tek.style.backgroundColor=""
                IP_hour.style.backgroundColor=""
                IP_day.style.backgroundColor="#FFE4C4"
                PRO.style.backgroundColor=""
                flag_ip = true;
                text_legend="Суточный показатель";
                path = '/charts/fetch-data-day/{{$id}}/data/'+_time;
                $.getJSON({
                    url: path,
                    method: 'GET',
                    success: function (data) {
                        options.series[0].data = data;
                        chart = new Highcharts.Chart(options);
                        old_date = data[data.length-1][0];
                        chart.series[0].color = colors_charts(data[data.length-1][1]);
                        chart.series[0].redraw();
                        chart.series[0].name=text_legend

                    }
                });
            });
            $("#ip-opo-pro").click(function() {
                // действия, которые будут выполнены при наступлении события...
                IP.style.backgroundColor=""
                PRO.style.backgroundColor="#FFE4C4"
                PRO_strelka.style.backgroundColor="#FFE4C4"
                PRO_hour.style.backgroundColor="#FFE4C4"
                PRO_day.style.backgroundColor=""
                PRO_month.style.backgroundColor=""
                text_legend="Часовой показатель";
                flag_ip = false;
                var btns=document.getElementsByClassName('button 1')
                for (var btn of btns){
                    btn.type="button"
                }
                var btns_pro=document.getElementsByClassName('button 2')
                for (var btn of btns_pro) {
                    btn.type = "hidden"
                }
                path = '/charts/fetch-data-prognoz/{{$id}}/data/'+_time;
                $.getJSON({
                    url: path,
                    method: 'GET',
                    success: function (data) {
                        options.series[0].data = data;
                        chart = new Highcharts.Chart(options);
                        old_date = data[data.length-1][0];
                        chart.series[0].color = colors_charts(data[data.length-1][1]);
                        chart.series[0].redraw();
                        chart.series[0].name=text_legend

                    }
                });
            });
            $("#ip-opo-pro-small-hour").click(function() {
                IP.style.backgroundColor=""
                PRO.style.backgroundColor="#FFE4C4"
                PRO_strelka.style.backgroundColor="#FFE4C4"
                PRO_hour.style.backgroundColor="#FFE4C4"
                PRO_day.style.backgroundColor=""
                PRO_month.style.backgroundColor=""
                text_legend="Часовой показатель";
                // действия, которые будут выполнены при наступлении события...
                flag_ip = false;
                var btns=document.getElementsByClassName('button 1')
                path = '/charts/fetch-data-prognoz/{{$id}}/data/'+_time;
                $.getJSON({
                    url: path,
                    method: 'GET',
                    success: function (data) {
                        options.series[0].data = data;
                        chart = new Highcharts.Chart(options);
                        old_date = data[data.length-1][0];
                        chart.series[0].color = colors_charts(data[data.length-1][1]);
                        chart.series[0].redraw();
                        chart.series[0].name=text_legend

                    }
                });
            });
            $("#ip-opo-pro-small-day").click(function() {
                IP.style.backgroundColor=""
                PRO.style.backgroundColor="#FFE4C4"
                PRO_strelka.style.backgroundColor="#FFE4C4"
                PRO_hour.style.backgroundColor=""
                PRO_day.style.backgroundColor="#FFE4C4"
                PRO_month.style.backgroundColor=""
                text_legend="Суточный показатель";
                // действия, которые будут выполнены при наступлении события...
                flag_ip = false;
                var btns=document.getElementsByClassName('button 1')
                path = '/charts/fetch-data-prognoz-day/{{$id}}/data/'+_time;
                $.getJSON({
                    url: path,
                    method: 'GET',
                    success: function (data) {
                        options.series[0].data = data;
                        chart = new Highcharts.Chart(options);
                        old_date = data[data.length-1][0];
                        chart.series[0].color = colors_charts(data[data.length-1][1]);
                        chart.series[0].redraw();
                        chart.series[0].name=text_legend

                    }
                });
            });
            $("#ip-opo-pro-small-month").click(function() {
                // действия, которые будут выполнены при наступлении события...
                IP.style.backgroundColor=""
                PRO.style.backgroundColor="#FFE4C4"
                PRO_strelka.style.backgroundColor="#FFE4C4"
                PRO_hour.style.backgroundColor=""
                PRO_day.style.backgroundColor=""
                PRO_month.style.backgroundColor="#FFE4C4"
                flag_ip = false;
                text_legend="Месячный показатель";
                var btns=document.getElementsByClassName('button 1')
                path = '/charts/fetch-data-prognoz-month/{{$id}}/data/'+_time;
                $.getJSON({
                    url: path,
                    method: 'GET',
                    success: function (data) {
                        options.series[0].data = data;
                        chart = new Highcharts.Chart(options);
                        old_date = data[data.length-1][0];
                        chart.series[0].color = colors_charts(data[data.length-1][1]);
                        chart.series[0].redraw();
                        chart.series[0].name=text_legend

                    }
                });
            });

            options = {
                title: {
                    text: 'Интегральный показатель ОПО' ,
                    style: {
                        display: 'none'
                    }
                },

                chart: {
                    renderTo: 'chart1',
                    type: 'area',
                    plotAreaWidth: 300,
                    plotAreaHeight: 75,


                    events: {
                        load: function () {
                            var series = this.series[0];
                            setInterval(() => {
                                $.getJSON({
                                    url: path,
                                    method: 'GET',
                                    success: function (data) {
                                        if (data[data.length-1][0] > old_date) {
                                            var x = data[data.length - 1][0],
                                                y = data[data.length - 1][1];
                                            series.addPoint([x, y], true, true);
                                            old_date = data[data.length-1][0];
                                            series.color = colors_charts(data[data.length-1][1]);
                                            series.redraw();
                                        }

                                    }

                                });
                                console.log(_time)
                            }, 6000);
                        }
                    }
                },
                xAxis: {
                    type: 'datetime',
                    gridLineWidth: 0
                },
                legend: {
                    enabled: false
                },


                yAxis: [{
                    min: 0,
                    max: 1,
                    stepSize: 0.5,

                    title: {
                        text: 'Интегральный показатель',
                        style: {
                            display: 'none'
                        }
                    },
                    labels: {
                        enabled:true
                    },
                    minorGridLineWidth: 0,
                    gridLineWidth: 1,
                    alternateGridColor: null,

                }],
                credits: {
                    enabled: false
                },

                series: [{
                    name: text_legend,
                    marker: {
                        enabled: false
                    },
                }]
            };
            $.getJSON({
                url: path,
                method: 'GET',
                success: function (data) {

                    options.series[0].data = data;
                    chart = new Highcharts.Chart(options);
                    old_date = data[data.length-1][0];
                    chart.series[0].color = colors_charts(data[data.length-1][1]);
                    chart.series[0].redraw();


                }
            });

    })

</script>



    <div class="period_block">
        <div class="period_header clear">
            <div class="ins_left clear">
                <button class="button" id="ip-opo" > Интегральный показатель </button>
                <input class="button 2" id="ip-opo-small" type="button" value="->">
                <input class="button 2" id="ip-opo-small-now" type="button" value="Текущий">
                <input class="button 2" id="ip-opo-small-hour" type="button" value="Часовой">
                <input class="button 2" id="ip-opo-small-day" type="button" value="Суточный">
                <input class="button 2" style="background-color: #FFFFFF" id="ip-opo-small-palka" type="button" value="|">

                <input class="button 1" id="ip-opo-pro-palka" style="background-color: #FFFFFF" type="hidden" value="|">
                <button class="button" id="ip-opo-pro" > Прогнозный показатель </button>
                <input class="button 1" id="ip-opo-pro-small" type="hidden" value="->">
                <input class="button 1" id="ip-opo-pro-small-hour" type="hidden" value="Часовой">
                <input class="button 1" id="ip-opo-pro-small-day" type="hidden" value="Суточный">
                <input class="button 1" id="ip-opo-pro-small-month" type="hidden" value="Месячный">
               </div>
            <div style="margin-top: -10px" class="ins_right clear">
                <p class="light_blue_text"> Выбор Даты :   <input text id="from" style="width: 100px" name="from" autocomplete="off" ></p>
            </div>
        </div>
        <div class="period_info">
            <div id="chart1" style="height: 170px; padding-top: 5px"></div>
{{--            @include('charts.chart_ip_opo')--}}
            {{--                <img alt="" src="replace/1.png">--}}
        </div>
        </div>


{{--    <label for="to">to</label>--}}
{{--    <input id="to" name="to">--}}

{{--    @include('web.include.script-lib.am4')--}}
{{--    @include('web.include.script-lib.highcharts')--}}
{{--@endsection--}}
