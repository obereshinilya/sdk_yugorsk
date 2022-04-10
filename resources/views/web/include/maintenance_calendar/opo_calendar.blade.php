@extends('web.layouts.app')
@section('title')
    Календарь технического обслуживания
@endsection

@section('content')

    <script>
        var opo_name="{{$opo_name}}";
        var by_id={{$opo_id}};

        $(document).ready(function (){
            $.getScript("{{asset('/js/modals_function.js')}}", function() {
                console.log("Script loaded but not necessarily executed.");
            });
        })

        var calendar_type='opo';


    </script>



    <link rel="stylesheet" href="{{asset('maintenance_calendar/maintenance.css')}}">
    <style>
        #add_new_maintenance_dialog{
            height: 400px;
        }
    </style>

    <div id="obj_name_div">
        <h3 id="obj_name_h">
            <script>
                $('#obj_name_h').text(opo_name+'. Календарь технического обслуживания')
            </script>
        </h3>
    </div>
    <div id="calendar"></div>
    <div class="overlay" data-close=""></div>
    <div id="add_new_maintenance_dialog" class="dlg-modal dlg-modal-slide">

        <div class="dialog_header">
            <span class="closer_btn" data-close="" ></span>
            <h3>Добавить новое техническое обслуживание</h3>
        </div>
        <form id="new_maintenance_form" onsubmit="return add_maintenance(this);">
            <input type="hidden" id="obj_id_input" value="">
            <div class="form-group">
                <label for="obj_id_select">Элемент ОПО</label>
                <select id="obj_id_select" name="obj_id_select">
                    <option disabled selected value="none">Выберите элемент ОПО</option>
                    @foreach($objects as $obj)
                        <option value="{{$obj->idObj}}">{{$obj->nameObj}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="maintenance_title">Комментарий</label>
                <input id="maintenance_title" type="text" name="maintenance_title" required="required">
            </div>
            <div class="form-dates">
                <div class="form-group date">
                    <label for="start_date">Дата начала</label>
                    <input id="start_date" type="text" name="start_date" required="required">
                </div>
                <div class="form-group date">
                    <label for="end_date">Дата окончания</label>
                    <input id="end_date" type="text" name="end_date" required="required">
                </div>
            </div>

            <div class="form-dates">
                <div class="form-group form_btn resize" >
                    <button type="submit" id="add_new_maintenance_button"></button>
                </div>
                <div class="form-group form_btn resize">
                    <button type="button" id="delete_maintenance_button">Удалить</button>
                </div>
            </div>
        </form>
    </div>



    @push('calendar_scripts')
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

        <script src="{{asset('/calendarEvents/fullcalendar/main.js')}}"></script>
        <script src="{{asset('/calendarEvents/fullcalendar/main.min.js')}}"></script>
        <link rel="stylesheet" href="{{asset('/calendarEvents/fullcalendar/main.css')}}">

        <script src="{{asset('/calendarEvents/datetimepicker/moment-with-locales.min.js')}}"></script>
        <script src="{{asset('/calendarEvents/datetimepicker/bootstrap.min.js')}}"></script>
        <script src="{{asset('/calendarEvents/datetimepicker/bootstrap-datetimepicker.min.js')}}"></script>
        <link rel="stylesheet" href="{{asset('/calendarEvents/datetimepicker/bootstrap.css')}}">
        <link rel="stylesheet" href="{{asset('/calendarEvents/datetimepicker/bootstrap-datetimepicker.css')}}">
        <script src="{{asset('/maintenance_calendar/calendar.js')}}"></script>

    @endpush
@endsection
