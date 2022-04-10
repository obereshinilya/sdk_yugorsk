


{{--<figure class="highcharts-figure">--}}
    <div id="container-chart_prognoz" style="height: 140px; width: 140px;
display: inline-block;">  </div>

{{--</figure>--}}


<script language="JavaScript">
    var gaugeOptions = {
        chart: {
            type: 'solidgauge'
        },

        title: null,

        pane: {
            center: ['50%', '65%'],
            size: '90%',
            startAngle: -130,
            endAngle: 130,
            background: {
                backgroundColor:
                    Highcharts.defaultOptions.legend.backgroundColor || '#EEE',
                innerRadius: '50%',
                outerRadius: '45%',
            }
        },

        exporting: {
            enabled: false
        },

        tooltip: {
            enabled: false
        },

        // the value axis
        yAxis: {
            stops: [
                [0.2, '#DF5353'], // red
                [0.4, '#e1e26c'], // yellow
                [0.9, '#81d773'] // green
                // [0.1, '#DF5353'] // red
            ],
            lineWidth: 0,
            tickWidth: 0,
            minorTickInterval: null,
            tickAmount: 2,
            title: {
                y: -30
            },
            labels: {
                y: 14
            }
        },

        plotOptions: {
            solidgauge: {
                dataLabels: {
                    y: -20,
                    borderWidth: 0,
                    useHTML: true
                }
            }
        }
    };

    // The speed gauge
    var chartSpeed = Highcharts.chart('container-chart_prognoz', Highcharts.merge(gaugeOptions, {
        yAxis: {
            min: 0,
            max: 1,
            title: {
                text: 'IP прогнозный',

            }
        },

        credits: {
            enabled: false
        },

        series: [{
            name: 'Speed',
            data: [{{\App\Http\Controllers\OpoController::ip_opo($opo_val->idOPO)}}],
            dataLabels: {
                format:
                    '<div style="text-align:center">' +
                    '<span style="font-size:20px"> {y} </span>' +
                    '</div>'
            }
        }]

    }));

    // The RPM gauge

    // Bring life to the dials
    setInterval(function () {
        // Speed
        var point,
            newVal,
            inc;

        if (chartSpeed) {
            point = chartSpeed.series[0].points[0];
{{--            @php--}}
{{--                use App\Http\Controllers\Opo_dayController;--}}
{{--                $result = Opo_dayController::view_one();--}}
{{--            @endphp--}}

           point.update({{\App\Http\Controllers\OpoController::ip_opo($opo_val->idOPO)}});
        }
    }, 5000);
</script>
