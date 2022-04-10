


<div id="chart_mini2" style="height: 95px; padding-top: 20px"></div>

<script language="JavaScript">
    $(document).ready(function() {

        var old_date;
        var options = {
            title: {
                text: 'Интегральный показатель ОПО' ,
                style: {
                    display: 'none'
                }
            },
            chart: {
                renderTo: 'chart_mini2',
                type: 'area',
                plotAreaWidth: 300,

            },
            xAxis: {
                categories: ['{{$data_month[12][1]}}', '{{$data_month[11][1]}}', '{{$data_month[10][1]}}', '{{$data_month[9][1]}}', '{{$data_month[8][1]}}', '{{$data_month[7][1]}}', '{{$data_month[6][1]}}',
                    '{{$data_month[5][1]}}', '{{$data_month[4][1]}}', '{{$data_month[3][1]}}', '{{$data_month[2][1]}}', '{{$data_month[1][1]}}' ],
                tickInterval: 2 , // 2 месяца интервал
                gridLineWidth: 1
            },
            legend: {
                enabled: false
            },

            yAxis: {
                min: 0,
                max: 50,
                title: {
                    text: '',
                    style: {
                        display: 'none'
                    }
                },
                minorGridLineWidth: 0,
                gridLineWidth: 0,
                alternateGridColor: null,

            },
            credits: {
                enabled: false
            },

            series: [{
                 name: 'Событий ПБ',
                data: [{{$data_month[12][0]}}, {{$data_month[11][0]}}, {{$data_month[10][0]}}, {{$data_month[9][0]}}, {{$data_month[8][0]}}, {{$data_month[7][0]}}, {{$data_month[6][0]}},
                    {{$data_month[5][0]}}, {{$data_month[4][0]}}, {{$data_month[3][0]}}, {{$data_month[2][0]}}, {{$data_month[1][0]}} ],
                marker: {
                    enabled: false
                },
            }]
        };

    var chart = new Highcharts.Chart(options);


    });

</script>
