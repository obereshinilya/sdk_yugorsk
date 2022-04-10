
<figure class="highcharts-figure">
    <div id="container-chart_2" class="chart-container"></div>

</figure>


<script language="JavaScript">
    var gaugeOptions = {
        chart: {
            type: 'solidgauge'
        },

        title: null,

        pane: {
            center: ['50%', '70%'],
            size: '130%',
            startAngle: -120,
            endAngle: 120,
            background: {
                backgroundColor:
                    Highcharts.defaultOptions.legend.backgroundColor || '#EEE',
                innerRadius: '40%',
                outerRadius: '40%',
                shape: 'arc'
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
            lineWidth: 1,
            tickWidth: 0,
            minorTickInterval: null,
            tickAmount: 2,
            title: {
                y: -65
            },
            labels: {
                y: 20
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
    var chartSpeed1 = Highcharts.chart('container-chart_2', Highcharts.merge(gaugeOptions, {
        yAxis: {
            min: 0,
            max: 1,
            title: {
                text: 'Интегральный показатель матрицы'
            }
        },

        credits: {
            enabled: false
        },

        series: [{
            name: 'Speed',
            data: [{{$result->elem_to_calc->take(-1)->first()->op_m}}],
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

        if (chartSpeed1) {
            point = chartSpeed1.series[0].points[0];
{{--            @php--}}
{{--                use App\Http\Controllers\Opo_dayController;--}}
{{--                $result1 = Opo_dayController::view_one();--}}
{{--            @endphp--}}

           point.update({{$result->elem_to_calc->take(-1)->first()->op_m}});
        }
    }, 5000);
</script>
