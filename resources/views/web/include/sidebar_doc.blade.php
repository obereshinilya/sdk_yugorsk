{{--@push('calendar_scripts')--}}
{{--    <script src="{{asset('/calendarEvents/datetimepicker/moment-with-locales.min.js')}}"></script>--}}
{{--    <script src="{{asset('/calendarEvents/datetimepicker/bootstrap.min.js')}}"></script>--}}
{{--    <script src="{{asset('/calendarEvents/datetimepicker/bootstrap-datetimepicker.min.js')}}"></script>--}}
{{--    <link rel="stylesheet" href="{{asset('/calendarEvents/datetimepicker/bootstrap.css')}}">--}}
{{--    <link rel="stylesheet" href="{{asset('/calendarEvents/datetimepicker/bootstrap-datetimepicker.css')}}">--}}

{{--@endpush--}}
<script src="{{asset('/calendarEvents/datetimepicker/moment-with-locales.min.js')}}"></script>
<script src="{{asset('/calendarEvents/datetimepicker/bootstrap.min.js')}}"></script>
<script src="{{asset('/calendarEvents/datetimepicker/bootstrap-datetimepicker.min.js')}}"></script>
<link rel="stylesheet" href="{{asset('/calendarEvents/datetimepicker/bootstrap.css')}}">
<link rel="stylesheet" href="{{asset('/calendarEvents/datetimepicker/bootstrap-datetimepicker.css')}}">



<div class="sidebar">
    <div class="inside_sidebar">
        @include('web.include.sidebar_top')
        {{--        <div class="tech_block_search_doc">--}}
        {{--            <form><input type="text" name="search" required placeholder="Поиск по разделу"></form>--}}
        {{--        </div>--}}
        <div class="clearfix"></div>


        <div class="sidebar_bottom rounded doc_sidebar">

            <div class="blocks_list">


                <div>
                    @can('product-list')
                        <label class="accordion">
                            <input type='checkbox' name='checkbox-accordion' id="faq" onclick="SaveChecked(this)">
                            <div class="accordion__header">Справочники</div>
                            <div class="accordion__content">
                                <a href="/docs/events">Возможные опасные события</a>
                                <a href="{{route('matrix')}}">Сценарии</a>
                                <a href="/docs/koef">Коэффициенты</a>
                                <a href="/docs/predRTN">Предписания РТН</a>
                                <a href="/docs/infoOPO">Справочник ОПО</a>
                                <a href="/docs/infoObj">Справочник элементов ОПО</a>
                                <a href="/docs/infoTB">Справочник ТБ элементов ОПО</a>
                                <a href="/docs/calendar_event">Справочник возможных событий</a>
                            </div>
                        </label>

                        <label class="accordion">
                            <input type='checkbox' name='checkbox-accordion'  id="docs" onclick="SaveChecked(this)">
                            <div class="accordion__header">Документация</div>
                            <div class="accordion__content">
                                <a href={{route('reglament')}}>Справочник технологических регламентов</a>
                                <a href={{route('upload_form')}}>Перечень нормативной документации</a>
                            </div>
                        </label>
                    @endcan
                    <label class="accordion">
                        <input type='checkbox' name='checkbox-accordion' id="plan" onclick="SaveChecked(this)">
                        <div class="accordion__header">
                            <a href={{ url('/docs/rtn') }}> План мероприятий по обеспечению ПБ</a>
                        </div>
                        <div class="accordion__content">
                            <a href="#">Общие сведения</a>
                            <a href="#">Раздел 1.1</a>
                            <a href="#">Раздел 2.1</a>
                            <a href="#">Раздел 2.2</a>
                            <a href="#">Раздел 3.1</a>
                            <a href="#">Раздел 4.1</a>
                            <a href="#">Раздел 4.2</a>
                            <a href="#">Раздел 4.3</a>
                            <a href="#">Раздел 5.1</a>
                            <a href="#">Раздел 5.2</a>
                        </div>
                    </label>
                    <label class="accordion">
                        <input type='checkbox' name='checkbox-accordion' id="plan2021" onclick="SaveChecked(this)">
                        <div class="accordion__header">
                            <a href={{ url('/docs/rtn2') }}>План мероприятий по обеспечению ПБ (2021г.)</a>
                        </div>
                    </label>
                    <label class="accordion">
                        <input type='checkbox' name='checkbox-accordion' id="gloss" onclick="SaveChecked(this)" >
                        <div class="accordion__header">
                            <a href={{ url('/docs/glossary') }}>  Глоссарий применяемых сокращений</a>
                        </div>
                        {{--                        <div class="accordion__content">--}}
                        {{--                            <a href="#">Сокращения</a>--}}
                        {{--                            <a href="#">Термины и определения</a>--}}
                        {{--                            <a href="#">Показатели промышленной безопасности</a>--}}
                        {{--                            <a href="#">Классификация событий</a>--}}
                        {{--                        </div>--}}
                    </label>
                    @can('product-create')
                        <label class="accordion">
                            <input type='checkbox' name='checkbox-accordion' id="report" onclick="SaveChecked(this)">
                            <div class="accordion__header">
                                <a href=''>Отчеты</a>
                            </div>
                            <div class="accordion__content">
                                <a href="#" class="clieckable_report" data-route="{{ route('xml_journal') }}">Журнал отправки XML</a>
                                <a href="{{ route('form51.index') }}">ОС о инциденте п 5.1</a>
                                <a href="{{ route('form52.index') }}">Акты тех. расследований о инциденте п 5.2</a>
                                <a href="{{ route('form5363.index') }}">Справки о выполнении мероприятий по результатам расследования и анализа коренных причин инцидентов п 5.3, 6.3</a>
                                <a href="{{ route('form61.index') }}">ОС о аварии п 6.1</a>
                                <a href="{{ route('form62.index') }}">Акты тех. расследований о аварии п 6.2</a>
                                <a href="{{ route('form5363.index') }}">Справки о выполнении мероприятий по результатам расследования и анализа коренных причин инцидентов п 5.3, 6.3</a>
                                {{--                            <a href="#">Термины и определения</a>--}}
                                {{--                            <a href="#">Показатели промышленной безопасности</a>--}}

                                <a href="#" onclick="Status_element()" id="mother_status">Отчет о состоянии элементов</a>
                                <div id="div_status" style="display: none">
                                    <a href="#" class="clieckable_report" id="status_element" data-route="{{ route('obj_status') }}" style="color: green; margin-left: 25px">За произвольный период</a>
                                    <a href="{{ route('status_elem_day') }}" id="status_element" style="color: green; margin-left: 25px">За день</a>
                                    <a href="{{ route('status_elem_month') }}" id="status_element" style="color: green; margin-left: 25px">За месяц</a>
                                    <a href="{{ route('status_elem_quarter') }}" id="status_element" style="color: green; margin-left: 25px">За квартал</a>
                                </div>

                                <a href="#" onclick="Scena_report()" id="mother_scena">Отчет о зафиксированных событиях</a>
                                <div id="div_scena" style="display: none">
                                    <a href="#" class="clieckable_report" id="report_scena" data-route="{{ route('scena_report') }}" style="color: green; margin-left: 25px">За произвольный период</a>
                                    <a href="{{ route('scena_report_day') }}" id="report_scena" style="color: green; margin-left: 25px">За день</a>
                                    <a href="{{ route('scena_report_month') }}" id="report_scena" style="color: green; margin-left: 25px">За месяц</a>
                                    <a href="{{ route('scena_report_quarter') }}" id="report_scena" style="color: green; margin-left: 25px">За квартал</a>
                                </div>

                                <a href="#" onclick="Result_pk()" id="mother_result">Сведения о результатах проверок</a>
                                <div id="div_result" style="display: none">
                                    <a href="#" class="clieckable_report" id="result_pk" data-route="{{ route('result_pk') }}" style="color: green; margin-left: 25px">За произвольный период</a>
                                    <a href="{{ route('result_pk_day') }}" id="result_pk" style="color: green; margin-left: 25px">За день</a>
                                    <a href="{{ route('result_pk_month') }}" id="result_pk" style="color: green; margin-left: 25px">За месяц</a>
                                    <a href="{{ route('result_pk_quarter') }}" id="result_pk" style="color: green; margin-left: 25px">За квартал</a>
                                </div>

                                <a href="#" onclick="Violations_report()" id="mother_violations_report">Отчет о выяленных нарушениях</a>
                                <div id="div_violations_report" style="display: none">
                                    <a href="#" class="clieckable_report" id="violations_report" data-route="{{ route('violations_report') }}" style="color: green; margin-left: 25px">За произвольный период</a>
                                    <a href="{{ route('violations_report_day') }}" id="violations_report" style="color: green; margin-left: 25px">За день</a>
                                    <a href="{{ route('violations_report_month') }}" id="violations_report" style="color: green; margin-left: 25px">За месяц</a>
                                    <a href="{{ route('violations_report_quarter') }}" id="violations_report" style="color: green; margin-left: 25px">За квартал</a>
                                </div>

                                <a href="#" onclick="Status_opo()" id="mother_status_opo">Отчет о состоянии ОПО</a>
                                <div id="div_status_opo" style="display: none">
                                    <a href="#" class="clieckable_report" id="status_opo" data-route="{{ route('status_opo') }}" style="color: green; margin-left: 25px">За произвольный период</a>
                                    <a href="{{ route('status_opo_day') }}" id="status_opo" style="color: green; margin-left: 25px">За день</a>
                                    <a href="{{ route('status_opo_month') }}" id="status_opo" style="color: green; margin-left: 25px">За месяц</a>
                                    <a href="{{ route('status_opo_quarter') }}" id="status_opo" style="color: green; margin-left: 25px">За квартал</a>
                                </div>

                                <a href="#" onclick="Repiat_report()" id="mother_repiat_report">Отчет "Анализ повторяемости несоответствий"</a>
                                <div id="div_repiat_report" style="display: none">
                                    <a href="#" class="clieckable_report" id="repiat_report" data-route="{{ route('repiat_report') }}" style="color: green; margin-left: 25px">За произвольный период</a>
                                    <a href="{{ route('repiat_report_day') }}" id="repiat_report" style="color: green; margin-left: 25px">За день</a>
                                    <a href="{{ route('repiat_report_month') }}" id="repiat_report" style="color: green; margin-left: 25px">За месяц</a>
                                    <a href="{{ route('repiat_report_quarter') }}" id="repiat_report" style="color: green; margin-left: 25px">За квартал</a>
                                </div>

                                <a href="#" onclick="Event_pk()" id="mother_event_pk">Отчет о проведенных контрольных мероприятиях</a>
                                <div id="div_event_pk" style="display: none">
                                    <a href="#" class="clieckable_report" id="event_pk" data-route="{{ route('event_pk') }}" style="color: green; margin-left: 25px">За произвольный период</a>
                                    <a href="{{ route('event_pk_day') }}" id="event_pk" style="color: green; margin-left: 25px">За день</a>
                                    <a href="{{ route('event_pk_month') }}" id="event_pk" style="color: green; margin-left: 25px">За месяц</a>
                                    <a href="{{ route('event_pk_quarter') }}" id="event_pk" style="color: green; margin-left: 25px">За квартал</a>
                                </div>
{{--                                <a href="{{ route('effect_pk') }}">Отчет об эффективности производственного контроля</a>--}}
                                <a href="{{route('effect_pk')}}">Отчет об эффективности производственного контроля</a>
                                <a href="#" class="clieckable_report" data-route="{{ route('info_act') }}">Справка о выполнении актов выданных службой, отделом промышленной безопасности, работником, ответственным за промышленную безопасность</a>
                                <a href="#" class="clieckable_report" data-route="{{ route('act_pb') }}">Справка о выполнении актов выданных органами надзора и контроля в области ПБ</a>

                                <a href="#" onclick="Quality_criteria()" id="mother_quality_criteria">Отчет о выявленных нарушениях на опасных производственных объектах по Критериям качественной оценки</a>
                                <div id="div_quality_criteria" style="display: none">
                                    <a href="#" class="clieckable_report" id="quality_criteria" data-route="{{ route('quality_criteria') }}" style="color: green; margin-left: 25px">За произвольный период</a>
                                    <a href="{{ route('quality_criteria_day') }}" id="quality_criteria" style="color: green; margin-left: 25px">За день</a>
                                    <a href="{{ route('quality_criteria_month') }}" id="quality_criteria" style="color: green; margin-left: 25px">За месяц</a>
                                    <a href="{{ route('quality_criteria_quarter') }}" id="quality_criteria" style="color: green; margin-left: 25px">За квартал</a>
                                </div>
                            </div>
                        </label>
                    @endcan
                </div>
            </div>
        </div>
    </div>
</div>
<form method="POST" id="choice_report_date" action="" style="opacity: 0">
    @csrf
    <div class="form-group date">
        <label for="start_date">Дата начала периода</label>
        <input type="text" name="start_date" id="start_date" autocomplete="off"/>
    </div>
    <div class="form-group date">

        <label for="finish_date">Дата окончания периода</label>
        <input type="text" name="finish_date" id="finish_date" autocomplete="off"/>
    </div>
    <div class="form-group">
        <button type="submit" style="margin-top: 10px" id="upload_report_btn">Добавить</button>
    </div>
</form>



<script>
    document.addEventListener('DOMContentLoaded', Check_history)

    function Check_history(){
        var mother = document.getElementById('mother_status');
        var div = document.getElementById('div_status');
        var mother_scena = document.getElementById('mother_scena');
        var div_scena = document.getElementById('div_scena');
        if (window.localStorage.getItem('remember_history')==null || window.localStorage.getItem('remember_history')!== "1") {
            div.style.display = "none";
            mother.style.color = "";
            mother.style.fontWeight = "";
        }
        if (window.localStorage.getItem('remember_history') === "1") {
            mother.style.color = "black";
            mother.style.fontWeight = "bold";
            div.style.display = "block";
        }
        if (window.localStorage.getItem('remember_history')==null || window.localStorage.getItem('remember_history')!== "2") {
            div_scena.style.display = "none";
            mother_scena.style.color = "";
            mother_scena.style.fontWeight = "";
        }
        if (window.localStorage.getItem('remember_history') === "2") {
            mother_scena.style.color = "black";
            mother_scena.style.fontWeight = "bold";
            div_scena.style.display = "block";
        }
        if (window.localStorage.getItem('remember_history')==null || window.localStorage.getItem('remember_history')!== "3") {
            div_result.style.display = "none";
            mother_result.style.color = "";
            mother_result.style.fontWeight = "";
        }
        if (window.localStorage.getItem('remember_history') === "3") {
            mother_result.style.color = "black";
            mother_result.style.fontWeight = "bold";
            div_result.style.display = "block";
        }
        if (window.localStorage.getItem('remember_history')==null || window.localStorage.getItem('remember_history')!== "4") {
            div_status_opo.style.display = "none";
            mother_status_opo.style.color = "";
            mother_status_opo.style.fontWeight = "";
        }
        if (window.localStorage.getItem('remember_history') === "4") {
            mother_status_opo.style.color = "black";
            mother_status_opo.style.fontWeight = "bold";
            div_status_opo.style.display = "block";
        }
        if (window.localStorage.getItem('remember_history')==null || window.localStorage.getItem('remember_history')!== "5") {
            div_violations_report.style.display = "none";
            mother_violations_report.style.color = "";
            mother_violations_report.style.fontWeight = "";
        }
        if (window.localStorage.getItem('remember_history') === "5") {
            mother_violations_report.style.color = "black";
            mother_violations_report.style.fontWeight = "bold";
            div_violations_report.style.display = "block";
        }
        if (window.localStorage.getItem('remember_history')==null || window.localStorage.getItem('remember_history')!== "6") {
            div_repiat_report.style.display = "none";
            mother_repiat_report.style.color = "";
            mother_repiat_report.style.fontWeight = "";
        }
        if (window.localStorage.getItem('remember_history') === "6") {
            mother_repiat_report.style.color = "black";
            mother_repiat_report.style.fontWeight = "bold";
            div_repiat_report.style.display = "block";
        }
        if (window.localStorage.getItem('remember_history')==null || window.localStorage.getItem('remember_history')!== "7") {
            div_event_pk.style.display = "none";
            mother_event_pk.style.color = "";
            mother_event_pk.style.fontWeight = "";
        }
        if (window.localStorage.getItem('remember_history') === "7") {
            mother_event_pk.style.color = "black";
            mother_event_pk.style.fontWeight = "bold";
            div_event_pk.style.display = "block";
        }
        if (window.localStorage.getItem('remember_history')==null || window.localStorage.getItem('remember_history')!== "8") {
            div_quality_criteria.style.display = "none";
            mother_quality_criteria.style.color = "";
            mother_quality_criteria.style.fontWeight = "";
        }
        if (window.localStorage.getItem('remember_history') === "8") {
            mother_quality_criteria.style.color = "black";
            mother_quality_criteria.style.fontWeight = "bold";
            div_quality_criteria.style.display = "block";
        }
    }

    function Status_element() {
        if (window.localStorage.getItem('remember_history')===null || window.localStorage.getItem('remember_history')!=="1"){
            window.localStorage.setItem('remember_history', '1');
        } else {
            window.localStorage.setItem('remember_history', '0');
        }
        Check_history();
    }
    function Quality_criteria() {
        if (window.localStorage.getItem('remember_history')===null || window.localStorage.getItem('remember_history')!=="8"){
            window.localStorage.setItem('remember_history', '8');
        } else {
            window.localStorage.setItem('remember_history', '0');
        }
        Check_history();
    }

    function Event_pk() {
        if (window.localStorage.getItem('remember_history')===null || window.localStorage.getItem('remember_history')!=="7"){
            window.localStorage.setItem('remember_history', '7');
        } else {
            window.localStorage.setItem('remember_history', '0');
        }
        Check_history();
    }

    function Scena_report() {
        if (window.localStorage.getItem('remember_history')===null || window.localStorage.getItem('remember_history')!=="2"){
            window.localStorage.setItem('remember_history', '2');
        } else {
            window.localStorage.setItem('remember_history', '0');
        }
        Check_history();
    }

    function Result_pk() {
        if (window.localStorage.getItem('remember_history')===null || window.localStorage.getItem('remember_history')!=="3"){
            window.localStorage.setItem('remember_history', '3');
        } else {
            window.localStorage.setItem('remember_history', '0');
        }
        Check_history();
    }

    function Status_opo() {
        if (window.localStorage.getItem('remember_history')===null || window.localStorage.getItem('remember_history')!=="4"){
            window.localStorage.setItem('remember_history', '4');
        } else {
            window.localStorage.setItem('remember_history', '0');
        }
        Check_history();
    }

    function Violations_report() {
        if (window.localStorage.getItem('remember_history')===null || window.localStorage.getItem('remember_history')!=="5"){
            window.localStorage.setItem('remember_history', '5');
        } else {
            window.localStorage.setItem('remember_history', '0');
        }
        Check_history();
    }
    function Repiat_report() {
        if (window.localStorage.getItem('remember_history')===null || window.localStorage.getItem('remember_history')!=="6"){
            window.localStorage.setItem('remember_history', '6');
        } else {
            window.localStorage.setItem('remember_history', '0');
        }
        Check_history();
    }

</script>


<script>
    let checkboxes = document.getElementsByName('checkbox-accordion');
    //console.log(checkboxes)
    function pageStart() {
        for (let ch of checkboxes) {
            if (window.localStorage[ch.id]){
                ch.checked=true;
            }
        }
    }

    function SaveChecked(element){
        //console.log(window.localStorage[element.id])
        if (window.localStorage[element.id]!=null){
            element.checked=false;
            window.localStorage.removeItem(element.id);
        }
        else {
            for (let ch of checkboxes){
                if (window.localStorage[ch.id]){
                    ch.checked=false;
                    window.localStorage.removeItem(ch.id);
                }
            }
            window.localStorage[element.id]=true;
        }

    }

    pageStart();
</script>


<script>
    document.addEventListener('DOMContentLoaded', function() {
        var modal_content=document.getElementById('choice_report_date');
        modal_content.style.opacity=1;
        var choice_report_date_modal=new ModalWindow('Укажите отчетный период', modal_content, AnimationsTypes['fadeIn']);

        {{--$(document).ready(function (){--}}
        {{--    $.getScript("{{asset('/js/modals_function.js')}}", function() {--}}
        {{--        console.log("Script loaded but not necessarily executed.");--}}
        {{--    });--}}
        {{--})--}}

        var report=document.getElementsByClassName('clieckable_report')
        // console.log(report)

        for (var r of report){
            r.addEventListener('click', function(){
                var event_start=$('#start_date')
                var event_end=$('#finish_date')
                // console.log(event_start)
                // console.log(event_end)
                var start_date_buffer=new Date()
                start_date_buffer.setHours(0, 0)

                event_start.datetimepicker({
                    maxDate:start_date_buffer,
                    locale: 'ru',
                    format: 'DD.MM.YYYY',
                    date:start_date_buffer
                });
                var end_date_buffer=new Date()
                end_date_buffer.setHours(23, 59)

                event_end.datetimepicker({
                    maxDate:end_date_buffer,
                    locale: 'ru',
                    format: 'DD.MM.YYYY',
                    date:end_date_buffer
                });
                var form=document.getElementById('choice_report_date')
                form.action=this.dataset.route
                // var modal=document.getElementById('choice_report_date_modal')
                choice_report_date_modal.show()
            })
        }
    })


    $('#finish_date').on('dp.change', function(e){
        try{
            $('#finish_date').data("DateTimePicker").minDate($('#start_date').data("DateTimePicker").date());
        }
        catch (err){
            console.log(err);
        }
    });
    $('#start_date').on('dp.change', function(e){
        try{
            $('#finish_date').data("DateTimePicker").minDate(e.date);
        }
        catch (err){
            console.log(err);
        }
    });

</script>

<style>
    /*#choice_report_date_modal{*/
    /*    width: 350px;*/
    /*    height: 300px;*/
    /*}*/

    /*#choice_report_date{*/
    /*    background: #ffffff;*/
    /*    width: 100%;*/
    /*    height: 90%;*/
    /*    border-radius: 4px;*/
    /*    box-sizing: border-box;*/
    /*    overflow: hidden;*/
    /*}*/

    .form-group {
        width: 100%;
        display: flex;
        flex-wrap: wrap;
        justify-content: space-between;
        margin: 0 0 20px;
    }


    .form-group:last-child {
        margin: 0;
    }
    .form-group label {
        display: block;
        margin: 0 0 10px;
        color: rgba(0, 0, 0, 0.6);
        font-size: 12px;
        font-weight: 500;
        line-height: 1;
        text-transform: uppercase;
        letter-spacing: 0.2em;
    }
    .form-group input {
        outline: none;
        display: block;
        background: rgba(0, 0, 0, 0.1);
        width: 100%;
        border: 0;
        border-radius: 4px;
        box-sizing: border-box;
        padding: 12px 20px;
        color: rgba(0, 0, 0, 0.6);
        font-family: inherit;
        font-size: inherit;
        font-weight: 500;
        line-height: inherit;
        transition: 0.3s ease;
    }

    .form-group input:focus {
        color: rgba(0, 0, 0, 0.8);
    }
    .form-group button {
        outline: none;
        background: #4285f4;
        width: 100%;
        border: 0;
        border-radius: 4px;
        padding: 12px 20px;
        color: #ffffff;
        font-family: inherit;
        font-size: inherit;
        font-weight: 500;
        line-height: inherit;
        text-transform: uppercase;
        cursor: pointer;
    }
</style>




