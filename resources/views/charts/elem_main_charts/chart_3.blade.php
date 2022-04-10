


<script language="JavaScript">


    // Themes begin
    am4core.useTheme(am4themes_animated);
    // Themes end

    {{--var Ip_elem = {{$this_elem->elem_to_calc->first()->op_r}};--}}

    // Create chart instance
    var chart3 = am4core.create("chartdiv2",
        am4charts.RadarChart,
        am4core.addLicense("ch-custom-attribution"));

    // Add data
    chart3.data = [{
        "category": "ОП Ррег",
        // "value": Ip_elem,
        "full": 1
    }];

    // Make chart not full circle
    chart3.startAngle = -250;
    chart3.endAngle = 70;
    chart3.radius = am4core.percent(100);
    chart3.innerRadius = am4core.percent(70);
    chart3.colors.saturation = 0.9;


    // Set number format
    //chart.numberFormatter.numberFormat = "#.#";


    // Create axes
    var categoryAxis = chart3.yAxes.push(new am4charts.CategoryAxis());
    categoryAxis.dataFields.category = "category";
    categoryAxis.renderer.grid.template.location = 0;
    categoryAxis.renderer.grid.template.strokeOpacity = 0;
    categoryAxis.renderer.labels.template.disabled = true
    categoryAxis.renderer.grid.template.disabled = true;

    //categoryAxis.renderer.labels.template.horizontalCenter = "right";
    //categoryAxis.renderer.labels.template.fontWeight = 100;
    /* categoryAxis.renderer.labels.template.adapter.add("fill", function(fill, target) {
      return (target.dataItem.index >= 0) ? chart.colors.getIndex(target.dataItem.index) : fill;
    }); */
    categoryAxis.renderer.minGridDistance = 40;

    var valueAxis = chart3.xAxes.push(new am4charts.ValueAxis());
    valueAxis.renderer.grid.template.strokeOpacity = 0;
    valueAxis.min = 0;
    valueAxis.max = 1;
    valueAxis.renderer.labels.template.disabled = true
    valueAxis.strictMinMax = true;

    var chart3yearLabel = chart3.radarContainer.createChild(am4core.Label);
    {{--chart3yearLabel.text = "[bold]{{$this_elem->elem_to_calc->first()->op_r}}[/]";--}}
    chart3yearLabel.horizontalCenter = 'middle'
    chart3yearLabel.verticalCenter = 'middle'
    chart3yearLabel.x = am4core.percent(100);
    chart3yearLabel.y = am4core.percent(100);
    chart3yearLabel.fontSize = 35; // irrelevant, can be omitted



    // Create series
    var chart3series1 = chart3.series.push(new am4charts.RadarColumnSeries());
    chart3series1.dataFields.valueX = "full";
    chart3series1.dataFields.categoryY = "category";
    chart3series1.clustered = false;
    chart3series1.columns.template.fill = new am4core.InterfaceColorSet().getFor("alternativeBackground");
    chart3series1.columns.template.fillOpacity = 0.04;
    chart3series1.columns.template.cornerRadiusTopLeft = 60;
    chart3series1.columns.template.strokeWidth = 0;
    chart3series1.columns.template.radarColumn.cornerRadius = 60;


    var chart3series2 = chart3.series.push(new am4charts.RadarColumnSeries());
    chart3series2.dataFields.valueX = "value";
    chart3series2.dataFields.categoryY = "category";
    chart3series2.clustered = false;
    // if (Ip_elem >= 0.8) {
    //     series2.columns.template.fill = am4core.color("rgba(105,175,112,0.5)");
    // }
    // if ((Ip_elem >= 0.5) && (Ip_elem < 0.8)) {
    //     series2.columns.template.fill = am4core.color("rgba(255,225,73,0.47)");
    // }
    // if ((Ip_elem >= 0.2) && (Ip_elem < 0.5)) {
    //     series2.columns.template.fill = am4core.color("rgb(242,177,64)");
    // }
    // if ((Ip_elem >= 0.0) && (Ip_elem < 0.2))
    //     series2.columns.template.fill = am4core.color("rgba(234,87,87,0.5)");
    chart3series2.columns.template.strokeOpacity = 0.4;
    chart3series2.columns.template.strokeWidth = 0;
    chart3series2.columns.template.tooltipText = "{category}: [bold]{value.formatNumber('#.00')}[/]";
    chart3series2.columns.template.radarColumn.cornerRadius = 60;


    // Add cursor
    //chart.cursor = new am4charts.RadarCursor();
</script>
