

<div id="chart_col_perfomans" style="height: 280px; padding-top: 10px"></div>
<script language="JavaScript">

  // $(document).ready(function() {
        Highcharts.chart('chart_col_perfomans', {
     //   var options = {
            title: {
                text: 'Интегральный показатель ОПО' ,
                style: {
                    display: 'none'
                }
            },
            chart: {
         //       renderTo: 'chart_col_tb',
                type: 'column'
                {{--events: {--}}
                {{--    load: function () {--}}
                {{--        var series = this.series[0];--}}
                {{--        setInterval(() => {--}}
                {{--            $.getJSON({--}}
                {{--                url: '/charts/fetch-data/{{$id}}',--}}
                {{--                method: 'GET',--}}
                {{--                success: function (data) {--}}
                {{--                    --}}{{--data = {{\App\Http\Controllers\Opo_dayController::view_day($id)}}--}}
                {{--                    if (data[data.length-1][0] > old_date) {--}}
                {{--                        var x = data[data.length - 1][0],--}}
                {{--                            y = data[data.length - 1][1];--}}
                {{--                        series.addPoint([x, y], true, true);--}}
                {{--                        old_date = data[data.length-1][0];--}}
                {{--                        console.log('Внутри');--}}
                {{--                    }--}}

                {{--                }--}}

                {{--            });--}}
                {{--        }, 10000);--}}
                {{--    }--}}
                {{--}--}}
            },
            xAxis: {
                categories: [
                    ' 1 квартал ',
                    ' 2 квартал ',
                    ' 3 квартал ',
                    ' 4 квартал ',

                ],
                crosshair: true
            },
            yAxis: {
                min: 0,
                title: {
                    text: 'Rainfall (mm)',
                    enabled: false

                }

            },
            tooltip: {
                headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
                pointFormat: '<tr><td style="color:{series.color};padding:0">{xAxis.categories}: </td>' +
                    '<td style="padding:0"><b>{point.y:.1f}</b></td></tr>',
                footerFormat: '</table>',
                shared: true,
                useHTML: true
            },
            plotOptions: {
                column: {
                    pointPadding: 0.2,
                    borderWidth: 0
                }
            },
            credits : {
                enabled: false
            },
            legend: {
                enabled: false
            },
            series: [{
                name: 'Tokyo',

                data: [80,80,85,82],
                color: {
                    linearGradient: {
                        x1: 0,
                        x2: 0,
                        y1: 0,
                        y2: 1
                    },
                    stops: [
                        [0, '#ADD8E6'],
                        [1, '#1E90FF']
                    ]
                }

            }]
   //     };
        {{--$.getJSON({--}}
        {{--    url: '/charts/fetch-data/{{$id}}',--}}
        {{--    method: 'GET',--}}
        {{--    success: function (data) {--}}
        {{--        data = {{\App\Http\Controllers\Opo_dayController::view_day($id)}}--}}
        {{--            options.series[0].data = data;--}}
        {{--        var chart = new Highcharts.Chart(options);--}}
        {{--        old_date = data[data.length-1][0];--}}
        {{--    }--}}
        {{--});--}}

    });
</script>
