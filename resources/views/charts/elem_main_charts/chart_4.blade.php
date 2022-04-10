


<script language="JavaScript">


    // Themes begin
    am4core.useTheme(am4themes_animated);
    // Themes end

    {{--var Ip_elem = {{$this_elem->elem_to_calc->first()->op_el}};--}}

    // Create chart instance
    var chart4 = am4core.create("chartdiv3",
        am4charts.RadarChart,
        am4core.addLicense("ch-custom-attribution"));

    // Add data
    chart4.data = [{
        "category": "ОП Ртр",
        // "value": Ip_elem,
        "full": 1
    }];

    // Make chart not full circle
    chart4.startAngle = -250;
    chart4.endAngle = 70;
    chart4.radius = am4core.percent(100);
    chart4.innerRadius = am4core.percent(70);
    chart4.colors.saturation = 0.9;


    // Set number format
    //chart.numberFormatter.numberFormat = "#.#";


    // Create axes
    var categoryAxis = chart4.yAxes.push(new am4charts.CategoryAxis());
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

    var valueAxis = chart4.xAxes.push(new am4charts.ValueAxis());
    valueAxis.renderer.grid.template.strokeOpacity = 0;
    valueAxis.min = 0;
    valueAxis.max = 1;
    valueAxis.renderer.labels.template.disabled = true
    valueAxis.strictMinMax = true;

    var chart4yearLabel = chart4.radarContainer.createChild(am4core.Label);
    {{--chart4yearLabel.text = "[bold]{{$this_elem->elem_to_calc->first()->op_el}}[/]";--}}
    chart4yearLabel.horizontalCenter = 'middle'
    chart4yearLabel.verticalCenter = 'middle'
    chart4yearLabel.x = am4core.percent(100);
    chart4yearLabel.y = am4core.percent(100);
    chart4yearLabel.fontSize = 35; // irrelevant, can be omitted



    // Create series
    var chart4series1 = chart4.series.push(new am4charts.RadarColumnSeries());
    chart4series1.dataFields.valueX = "full";
    chart4series1.dataFields.categoryY = "category";
    chart4series1.clustered = false;
    chart4series1.columns.template.fill = new am4core.InterfaceColorSet().getFor("alternativeBackground");
    chart4series1.columns.template.fillOpacity = 0.04;
    chart4series1.columns.template.cornerRadiusTopLeft = 60;
    chart4series1.columns.template.strokeWidth = 0;
    chart4series1.columns.template.radarColumn.cornerRadius = 60;

    var chart4series2 = chart4.series.push(new am4charts.RadarColumnSeries());
    chart4series2.dataFields.valueX = "value";
    chart4series2.dataFields.categoryY = "category";
    chart4series2.clustered = false;
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
    chart4series2.columns.template.strokeOpacity = 0.4;
    chart4series2.columns.template.strokeWidth = 0;
    chart4series2.columns.template.tooltipText = "{category}: [bold]{value.formatNumber('#.00')}[/]";
    chart4series2.columns.template.radarColumn.cornerRadius = 60;


    // Add cursor
    //chart.cursor = new am4charts.RadarCursor();
</script>
