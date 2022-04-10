


<div id="chart_mini" style="height: 100px; padding-top: 10px"></div>

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
                renderTo: 'chart_mini',
                type: 'area',
                plotAreaWidth: 300,
                plotAreaHeight: 75,


                events: {
                    load: function () {
                        var series = this.series[0];
                        setInterval(() => {
                            $.getJSON({
                                url: '/charts/fetch-data/{{$id}}',
                                method: 'GET',
                                success: function (data) {
                            {{--data = {{\App\Http\Controllers\Opo_dayController::view_day($id)}}--}}
                                    if (data[data.length-1][0] > old_date) {
                                        var x = data[data.length - 1][0],
                                            y = data[data.length - 1][1];
                                        series.addPoint([x, y], true, true);
                                        old_date = data[data.length-1][0];
                                    }

                               }

                           });
                        }, 10000);
                    }
                }
            },
            xAxis: {
                type: 'datetime',
                gridLineWidth: 1
            },
            legend: {
                enabled: false
            },

            yAxis: {
                min: 0,
                max: 1,
                title: {
                    text: 'Интегральный показатель',
                    style: {
                        display: 'none'
                    }
                },
            labels: {
                enabled:false
            },
                minorGridLineWidth: 0,
                gridLineWidth: 0,
                alternateGridColor: null,

            },
            credits: {
                enabled: false
            },

            series: [{
                 name: 'Текущий показатель',
                marker: {
                    enabled: false
                },
            }]
        };
        $.getJSON({
             url: '/charts/fetch-data/{{$id}}',
            method: 'GET',
            success: function (data) {
                {{--data = {{\App\Http\Controllers\Opo_dayController::view_day($id)}}--}}
                options.series[0].data = data;
                var chart = new Highcharts.Chart(options);
                old_date = data[data.length-1][0];
                if (data[data.length-1][1]<=1.00) {
                    chart.series[0].color = "rgba(70,183,78,0.5)";
                    chart.series[0].redraw();
                }
                if (data[data.length-1][1]<=0.80) {
                    chart.series[0].color = "#fae6ae";
                    chart.series[0].redraw();
                }
                if (data[data.length-1][1]<=0.50) {
                    chart.series[0].color = "#f2b140";
                    chart.series[0].redraw();
                }
                if (data[data.length-1][1]<=0.20) {
                    chart.series[0].color = "rgba(234,87,87,0.5)";
                    chart.series[0].redraw();
                }
            }
        });
    });

</script>
