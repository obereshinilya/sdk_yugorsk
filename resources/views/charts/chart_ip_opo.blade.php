


<div id="chart1" style="height: 190px"></div>

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
                renderTo: 'chart1',
                type: 'area',
                plotAreaWidth: 300,
                plotAreaHeight: 75,


                events: {
                    load: function () {
                        var series = this.series[0];
                        setInterval(() => {
                            $.getJSON({
                                url: '/charts/fetch-data_day/{{$id}}',
                                method: 'GET',
                                success: function (data) {
                                    if (data[data.length-1][0] > old_date) {
                                        var x = data[data.length - 1][0],
                                            y = data[data.length - 1][1];
                                        series.addPoint([x, y], true, true);
                                        old_date = data[data.length-1][0];
                                        console.log('Внутри');
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
                minorGridLineWidth: 0,
                gridLineWidth: 0,
                alternateGridColor: null,
                // plotBands: [{ // Light air
                //     from: 0,
                //     to: 0.2,
                //     color: 'rgba(250, 128, 114, 0.4)',
                //     label: {
                //         text: 'Авария',
                //         style: {
                //             color: '#606060'
                //         }
                //     }
                // }, { // Light breeze
                //     from: 0.2,
                //     to: 0.5,
                //     color: 'rgba(255, 165, 0, 0.4)',
                //     label: {
                //         text: 'Инцедент',
                //         style: {
                //             color: '#606060'
                //         }
                //     }
                // }, { // Gentle breeze
                //     from: 0.5,
                //     to: 0.8,
                //     color: 'rgba(240, 230, 140, 0.6)',
                //     label: {
                //         text: 'Низкий риск',
                //         style: {
                //             color: '#606060'
                //         }
                //     }
                // }, { // Moderate breeze
                //     from: 0.8,
                //     to: 1.0,
                //     color: 'rgba(152, 251, 152, 0.3)',
                //     label: {
                //         text: 'Работа штатно',
                //         style: {
                //             color: '#606060'
                //         }
                //     }
                // }]
            },
            credits: {
                enabled: false
            },

            series: [{
                 name: 'IP ОПО',
                marker: {
                    enabled: false
                },
            }]
        };
        $.getJSON({
            url: '/charts/fetch-data_day/{{$id}}',
            method: 'GET',
            success: function (data) {
                options.series[0].data = data;
                var chart = new Highcharts.Chart(options);
                old_date = data[data.length-1][0];
            }
        });
    });

</script>
