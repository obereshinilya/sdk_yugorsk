
<style>
    #chartdiv {
        width: 100%;
        height: 150px;
    }

</style>

{{--<div id="chartdiv"></div>--}}


<script language="JavaScript">
    /**
     * ---------------------------------------
     * This demo was created using amCharts 4.
     *
     * For more information visit:
     * https://www.amcharts.com/
     *
     * Documentation is available at:
     * https://www.amcharts.com/docs/v4/
     * ---------------------------------------
     */

    // Themes begin
    am4core.useTheme(am4themes_animated);
    // Themes end


    var Ip_elem = {{$ver_opo->opo_to_calc1->first()->ip_opo}};
    // Create chart instance
    var chart = am4core.create("chartdiv",
        am4charts.RadarChart,
        am4core.addLicense("ch-custom-attribution"));

    // Add data
    chart.data = [{
        "category": "IP OPO",
        "value": Ip_elem,
        "full": 1
    }];
    // Make chart not full circle
    chart.startAngle = -250;
    chart.endAngle = 70;
    chart.radius = am4core.percent(100);
    chart.innerRadius = am4core.percent(70);
    chart.colors.saturation = 0.9;

    // Set number format
    //chart.numberFormatter.numberFormat = "#.#";


    var categoryAxis = chart.yAxes.push(new am4charts.CategoryAxis());
    categoryAxis.dataFields.category = "category";
    categoryAxis.renderer.grid.template.location = 0;
    categoryAxis.renderer.grid.template.strokeOpacity = 0.04;
    categoryAxis.renderer.labels.template.disabled = true
    categoryAxis.renderer.grid.template.disabled = true;
    categoryAxis.renderer.minGridDistance = 40;

    var valueAxis = chart.xAxes.push(new am4charts.ValueAxis());
    valueAxis.renderer.grid.template.strokeOpacity = 0;
    valueAxis.min = 0;
    valueAxis.max = 1;
    valueAxis.renderer.labels.template.disabled = true;

    var yearLabel = chart.radarContainer.createChild(am4core.Label);
    yearLabel.text = "[bold]{{$ver_opo->opo_to_calc1->first()->ip_opo}}[/]";
    yearLabel.horizontalCenter = 'middle'
    yearLabel.verticalCenter = 'middle'
    yearLabel.x = am4core.percent(100);
    yearLabel.y = am4core.percent(100);
    yearLabel.fontSize = 35; // irrelevant, can be omitted



    // Create series
    var series1 = chart.series.push(new am4charts.RadarColumnSeries());
    series1.dataFields.valueX = "full";
    series1.dataFields.categoryY = "category";
    series1.clustered = false;
    series1.columns.template.fill = new am4core.InterfaceColorSet().getFor("alternativeBackground");
    series1.columns.template.fillOpacity = 0.05;
    series1.columns.template.cornerRadiusTopLeft = 40;
    series1.columns.template.strokeWidth = 0;
    series1.columns.template.radarColumn.cornerRadius = 40;

    var series2 = chart.series.push(new am4charts.RadarColumnSeries());
    series2.dataFields.valueX = "value";
    series2.dataFields.categoryY = "category";
    series2.clustered = false;
    if (Ip_elem >= 0.8) {
        series2.columns.template.fill = am4core.color("rgba(105,175,112,0.5)");
    }
    if ((Ip_elem >= 0.5) && (Ip_elem < 0.8)) {
        series2.columns.template.fill = am4core.color("rgba(255,225,73,0.47)");
    }
    if ((Ip_elem >= 0.2) && (Ip_elem < 0.5)) {
        series2.columns.template.fill = am4core.color("rgb(242,177,64)");
    }
    if ((Ip_elem >= 0.0) && (Ip_elem < 0.2))
        series2.columns.template.fill = am4core.color("rgba(234,87,87,0.5)");

    series2.columns.template.strokeOpacity = 0.4;
    series2.columns.template.strokeWidth = 0;
    series2.columns.template.tooltipText = "{category}: [bold]{value}[/]";
    series2.columns.template.radarColumn.cornerRadius = 60;

    // Add cursor
    //chart.cursor = new am4charts.RadarCursor();
</script>
