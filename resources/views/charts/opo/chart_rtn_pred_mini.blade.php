


<div id="chart_mini1" style="height: 95px; padding-top: 20px; width: 30%;"></div>

<script language="JavaScript">
    Highcharts.chart('chart_mini1', {
        chart: {
            type: 'bar'
        },
        title: {
            text: ''
        },
        xAxis: {
            categories: [''],
            title: {
                text: null
            },
        },
        yAxis: {
            min: 0,
            title: {
                text: '',
                align: 'high'
            },
            labels: {
                overflow: 'justify'
            }
        },
        tooltip: {
            valueSuffix: ''
        },
        plotOptions: {
            bar: {
                dataLabels: {
                    enabled: true
                }
            }
        },
        legend: {
            layout: 'vertical',
            align: 'right',
            verticalAlign: 'top',
            x: -40,
            y: 80,
            floating: true,
            borderWidth: 1,
            backgroundColor:
                Highcharts.defaultOptions.legend.backgroundColor || '#FFFFFF',
            shadow: true
        },
        credits: {
            enabled: false
        },
        series: [{
            name: 'Выдано',
            data: [{{count($data_rtn_noncheck)}}],
            color: 'rgba(234,1,1,1)'
        }, {
            name: 'Выполнено',
            data: [{{count($data_rtn_check)}}],
            color: 'rgba(1,234,1,1)',
        }, ]
    });
</script>
