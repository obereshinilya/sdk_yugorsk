


<div id="chart_mini" style="height: 95px; padding-top: 20px"></div>

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

            },
            xAxis: {
                categories: ['Январь', 'Апрель', 'Июль', 'Октябрь'],
                gridLineWidth: 1
            },
            legend: {
                enabled: false
            },

            yAxis: {
                min: 0,
                max: 100,
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
                 name: 'IP ОПО',
                data: [80, 96, 95, 75],
                marker: {
                    enabled: false
                },
            }]
        };

    var chart = new Highcharts.Chart(options);


    });

</script>
