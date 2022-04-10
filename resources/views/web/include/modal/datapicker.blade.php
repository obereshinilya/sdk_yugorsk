@push('datapicker')
    <link rel="stylesheet" href="{{asset('js/jquery/jquery-ui.css')}}">
    <script src="{{asset('js/jquery/jquery1.12.4.js')}}"></script>
    <script src="{{asset('js/jquery/jquery-ui.js')}}"></script>
@endpush

<script language="JavaScript">
    var ids = 1;

    var today = new Date();
    var dd = today.getDate();
    var mm = today.getMonth()+1; //January is 0!
    var yyyy = today.getFullYear();
    if(dd<10) {  dd = '0'+dd }
    if(mm<10) {  mm = '0'+mm }
    var _time = yyyy + '-' + mm + '-' + dd;

    $.datepicker.regional['ru'] = {
        closeText: 'Закрыть',
        prevText: 'Предыдущий',
        nextText: 'Следующий',
        currentText: 'Сегодня',
        monthNames: ['Январь','Февраль','Март','Апрель','Май','Июнь','Июль','Август','Сентябрь','Октябрь','Ноябрь','Декабрь'],
        monthNamesShort: ['Янв','Фев','Мар','Апр','Май','Июн','Июл','Авг','Сен','Окт','Ноя','Дек'],
        dayNames: ['воскресенье','понедельник','вторник','среда','четверг','пятница','суббота'],
        dayNamesShort: ['вск','пнд','втр','срд','чтв','птн','сбт'],
        dayNamesMin: ['Вс','Пн','Вт','Ср','Чт','Пт','Сб'],
        weekHeader: 'Не',
        dateFormat: 'dd.mm.yy',
        firstDay: 1,
        isRTL: false,
        showMonthAfterYear: false,
        yearSuffix: ''
    };
    $.datepicker.setDefaults($.datepicker.regional['ru']);

    $( function() {
        var dateFormat = 'yyyy-mm-dd',
            from = $( "#from" )
                .datepicker({
                    defaultDate: "+0D",
                    // changeMonth: true,
                    // numberOfMonths: 1,
                    dateFormat: "yy-mm-dd",
                    showButtonPanel: true,
                    maxDate: "+0D",
                    onSelect: function(dateText) {
                        _time = this.value;


                        console.log(path);
                        $.getJSON({
                            url: path,
                            method: 'GET',
                            success: function (data) {
                                options.series[0].data = data;
                                chart = new Highcharts.Chart(options);
                                old_date = data[data.length-1][0];
                                chart.series[0].color = colors_charts(data[0][1]);
                                chart.series[0].redraw();

                            }
                        });
                    }
                })
                .on( "change", function() {
                    to.datepicker( "option", "minDate", getDate( this ) );
                }),
            to = $( "#to" ).datepicker({
                defaultDate: "+1w",
                changeMonth: true,
                numberOfMonths: 1
            })
                .on( "change", function() {
                    from.datepicker( "option", "maxDate", getDate( this ) );
                });

        function getDate( element ) {
            var date;
            try {
                date = $.datepicker.parseDate( dateFormat, element.value );

            } catch( error ) {
                date = null;
            }

            return date;
        }
    } );






</script>