




<script language="JavaScript">


    // Themes begin
    am4core.useTheme(am4themes_animated);
    // Themes end

   {{--var Ip_elem = {{$this_elem->elem_to_calc->first()->ip_elem}};--}}

    // Create chart instance
    var chart1 = am4core.create("chartdiv",
        am4charts.RadarChart,
        am4core.addLicense("ch-custom-attribution"),
    );

    // Add data
    chart1.data = [{
        "category": "ИП Рэл",
        'value':0,
        "full": 1
    }];


    // Make chart not full circle
    chart1.startAngle = -250;
    chart1.endAngle = 70;
    chart1.radius = am4core.percent(100);
    chart1.innerRadius = am4core.percent(70);
    chart1.colors.saturation = 0.9;


    // Set number format
    //chart1.numberFormatter.numberFormat = "#.#";


    // Create axes
    var categoryAxis = chart1.yAxes.push(new am4charts.CategoryAxis());
    categoryAxis.dataFields.category = "category";
    categoryAxis.renderer.grid.template.location = 0;
    categoryAxis.renderer.grid.template.strokeOpacity = 0;
    categoryAxis.renderer.labels.template.disabled = true
    categoryAxis.renderer.grid.template.disabled = true;
    categoryAxis.renderer.minGridDistance = 40;

    var valueAxis = chart1.xAxes.push(new am4charts.ValueAxis());
    valueAxis.renderer.grid.template.strokeOpacity = 0;
    valueAxis.min = 0;
    valueAxis.max = 1;
    valueAxis.renderer.labels.template.disabled = true
    valueAxis.strictMinMax = true;

    var chart1yearLabel = chart1.radarContainer.createChild(am4core.Label);
    {{--yearLabel.text = "[bold]{{$this_elem->elem_to_calc->first()->ip_elem}}[/]";--}}
        chart1yearLabel.horizontalCenter = 'middle'
    chart1yearLabel.verticalCenter = 'middle'
    chart1yearLabel.x = am4core.percent(100);
    chart1yearLabel.y = am4core.percent(100);
    chart1yearLabel.fontSize = 35; // irrelevant, can be omitted



    // Create series
    var chart1series1 = chart1.series.push(new am4charts.RadarColumnSeries());
    chart1series1.dataFields.valueX = "full";
    chart1series1.dataFields.categoryY = "category";
    chart1series1.clustered = false;
    chart1series1.columns.template.fill = new am4core.InterfaceColorSet().getFor("alternativeBackground");
    chart1series1.columns.template.fillOpacity = 0.04;
    chart1series1.columns.template.cornerRadiusTopLeft = 60;
    chart1series1.columns.template.strokeWidth = 0;
    chart1series1.columns.template.radarColumn.cornerRadius = 60;


    var chart1series2 = chart1.series.push(new am4charts.RadarColumnSeries());
    chart1series2.dataFields.valueX = "value";
    chart1series2.dataFields.categoryY = "category";
    chart1series2.clustered = false;
    // if (Ip_elem >= 0.8) {
    //       series2.columns.template.fill = am4core.color("rgba(105,175,112,0.5)");
    // }
    // if ((Ip_elem >= 0.5) && (Ip_elem < 0.8)) {
    //       series2.columns.template.fill = am4core.color("rgba(255,225,73,0.47)");
    // }
    // if ((Ip_elem >= 0.2) && (Ip_elem < 0.5)) {
    //       series2.columns.template.fill = am4core.color("rgb(242,177,64)");
    // }
    // if ((Ip_elem >= 0.0) && (Ip_elem < 0.2))
    //     series2.columns.template.fill = am4core.color("rgba(234,87,87,0.5)");

    chart1series2.columns.template.strokeOpacity = 0.4;
    chart1series2.columns.template.strokeWidth = 0;
    chart1series2.columns.template.tooltipText = "{category}: [bold]{value.formatNumber('#.00')}[/]";
    chart1series2.columns.template.radarColumn.cornerRadius = 60;

    // chart1.data[0]['value']=1;
    // yearLabel.text = "[bold]1[/]";
    // Add cursor
    //chart.cursor = new am4charts.RadarCursor();
</script>
