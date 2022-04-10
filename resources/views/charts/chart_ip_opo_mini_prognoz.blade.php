


<div id="chart_mini_prognoz" style="height: 100px; margin-top: 10px"></div>

<script language="JavaScript">
    $(document).ready(function() {

        var old_date1;
        var options1 = {
            title: {
                text: 'Интегральный показатель ОПО' ,
                style: {
                    display: 'none'
                }
            },
            chart: {
                renderTo: 'chart_mini_prognoz',
                type: 'area',
                plotAreaWidth: 300,
                plotAreaHeight: 75,


                events: {
                    load: function () {
                        var series1 = this.series[0];
                        setInterval(() => {
                            $.getJSON({
                                url: '/charts/fetch-data-prognoz/{{$id}}',
                                method: 'GET',
                                success: function (data) {
                                    if (data[data.length-1][0] > old_date1) {
                                        var x = data[data.length - 1][0],
                                            y = data[data.length - 1][1];
                                        series1.addPoint([x, y], true, true);
                                        old_date1 = data[data.length-1][0];
                                        console.log('Внутри');
                                    }
                                    if (data[data.length-1][1]<=1.00) {
                                        chart1.series[0].color = "rgba(70,183,78,0.5)";
                                        chart1.series[0].redraw();
                                    }
                                    if (data[data.length-1][1]<=0.80) {
                                        chart1.series[0].color = "#fae6ae";
                                        chart1.series[0].redraw();
                                    }
                                    if (data[data.length-1][1]<=0.50) {
                                        chart1.series[0].color = "#f2b140";
                                        chart1.series[0].redraw();
                                    }
                                    if (data[data.length-1][1]<=0.20) {
                                        chart1.series[0].color = "rgba(234,87,87,0.5)";
                                        chart1.series[0].redraw();
                                    }
                                }

                            });
                        }, 10000);
                    }
                }
            },
            xAxis: {
                type: 'datetime',
                gridLineWidth: 0.5,

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
               name: 'Прогнозный показатель',
               marker: {
                    enabled: false
                },

               // color :"#e9c199",
            }]
        };
        $.getJSON({
            url: '/charts/fetch-data-prognoz/{{$id}}',
            method: 'GET',
            success: function (data) {
                options1.series[0].data = data;

                var chart1 = new Highcharts.Chart(options1);
                old_date1 = data[data.length-1][0];

                //     var series = chart1.series[0];
                // series.setData(data);
                if (data[data.length-1][1]<=1.00) {
                    chart1.series[0].color = "rgba(70,183,78,0.5)";
                   chart1.series[0].redraw();
                }
                if (data[data.length-1][1]<=0.80) {
                    chart1.series[0].color = "#fae6ae";
                   chart1.series[0].redraw();
                }
                if (data[data.length-1][1]<=0.50) {
                    chart1.series[0].color = "#f2b140";
                   chart1.series[0].redraw();
                }
                if (data[data.length-1][1]<=0.20) {
                    chart1.series[0].color = "rgba(234,87,87,0.5)";
                   chart1.series[0].redraw();
                }
            }

        });
    });

</script>
