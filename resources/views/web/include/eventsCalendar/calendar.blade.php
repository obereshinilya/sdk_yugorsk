{{--<!DOCTYPE html>--}}
{{--<html>--}}
@extends('web.layouts.app')
@section('title')
    Календарь событий
@endsection

@section('content')

<script>
    var opo_id={{$opo_id}};
    var user_id={{ Auth::user()->id }};
    var opo_name=`{{$opo_name}}`;

    $(document).ready(function (){
        $.getScript("{{asset('/js/modals_function.js')}}", function() {
            console.log("Script loaded but not necessarily executed.");
        });
    })


    // console.log(opo_name)
</script>



<style>
    /*--- CONTENT ---*/
    #calendar_event_content {
        width:100%; /* ширина нашего блока */
        height:95%; /* высота нашего блока */
    }
    .textArea {
        width: 90%; /* Ширина поля в процентах */
        height: 200px; /* Высота поля в пикселах */
        resize: none; /* Запрещаем изменять размер */
    }

    .calendar_page_modal_btn{
        background-color: #008CBA;
        border: none;
        color: white;
        padding: 8px 24px;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        font-size: 11px;
        margin: 4px 2px;
        cursor: pointer;
    }
</style>


{{--<head>--}}
{{--    <title>Календарь событий</title>--}}
{{--    <meta name="csrf-token" content="{{csrf_token()}}">--}}
{{--    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" />--}}
{{--    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>--}}

{{--    <script src="{{asset('/calendarEvents/fullcalendar/main.js')}}"></script>--}}
{{--    <script src="{{asset('/calendarEvents/fullcalendar/main.min.js')}}"></script>--}}
{{--    <link rel="stylesheet" href="{{asset('/calendarEvents/fullcalendar/main.css')}}">--}}

{{--    <script src="{{asset('/calendarEvents/datetimepicker/moment-with-locales.min.js')}}"></script>--}}
{{--    <script src="{{asset('/calendarEvents/datetimepicker/bootstrap.min.js')}}"></script>--}}
{{--    <script src="{{asset('/calendarEvents/datetimepicker/bootstrap-datetimepicker.min.js')}}"></script>--}}
{{--    <link rel="stylesheet" href="{{asset('/calendarEvents/datetimepicker/bootstrap.min.css')}}">--}}
{{--    <link rel="stylesheet" href="{{asset('/calendarEvents/datetimepicker/bootstrap-datetimepicker.min.css')}}">--}}


{{--    <script src="{{asset('/calendarEvents/calendarEvents.js')}}"></script>--}}

{{--    --}}{{--    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.css" />--}}
{{--    --}}{{--    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>--}}
{{--    --}}{{--    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.js"></script>--}}

{{--</head>--}}
{{--<body>--}}
    <div id="opo_name_div">
        <h2 id="opo_name_h">
            <script>
                $('#opo_name_h').text(opo_name)
            </script>
        </h2>
    </div>
    <div id="calendar"></div>
{{--    <div class="overlay" data-close=""></div>--}}
{{--    <div id="calendar_event_info_modal" class="dlg-modal dlg-modal-slide">--}}
{{--        <div class="modal_header">--}}
{{--            <span class="closer_btn" data-close=""></span>--}}
{{--            <h3 id="event_title"></h3>--}}
{{--        </div>--}}
        <div id="calendar_event_content">
            <input type="hidden" id="current_event_id" value="">
            <p id="event_description"></p>
            <p id="event_start_datetime"></p>
            <p id="event_end_datetime"></p>
            <p id="event_type"></p>
            <p id="event_dest_user"></p>
            <p id="event_create_user"></p>
            <p id="event_status"></p>
            <p>
                <input type="button" id="event_confirm_btn" class="calendar_page_modal_btn" value="">
                <input type="button" id="delete_this_event_btn" class="calendar_page_modal_btn" value="Удалить">
                <input type="button" id="change_this_event_btn" class="calendar_page_modal_btn" value="Изменить">
            </p>
        </div>

{{--    </div>--}}


{{--    <div id="new_calendar_event_modal" class="dlg-modal dlg-modal-slide">--}}
{{--        <div class="modal_header">--}}
{{--            <span class="closer_btn" data-close=""></span>--}}
{{--            <h3 id="new_event_modal_title">Новое событие</h3>--}}
{{--        </div>--}}
        <div id="new_calendar_event_content">
            <p>
                <label for="new_event_title">Событие: </label>
                <input type="text" id="new_event_title"  value="" autocomplete="off">
            </p>
            <p>
                <label for="new_event_description">Описание события:</label>
                <textarea class="textArea" id="new_event_description"></textarea>
            </p>
            <p>
                <label for="new_event_start">Начало:</label>
                <input type="text" name="new_event_start" id="new_event_start" autocomplete="off"/>
            </p>
            <p>
                <label for="new_event_end">Конец:</label>
                <input type="text" name="new_event_end"  id="new_event_end" autocomplete="off"/>
            </p>
            <p>
                <label for="new_event_type">Тип события:</label>
                <select id="new_event_type">
                    @foreach($types as $type)
                        <option value="{{$type->id}}">{{$type->name}}</option>
                    @endforeach
                </select>
            </p>
            <p>
               <label for="new_event_dest_user">Ответственный:</label>
                <select id="new_event_dest_user">
                    @foreach($users as $usr)
                        <option value="{{$usr->id}}">{{$usr->name}}</option>
                    @endforeach
                </select><br>
            </p>
            <p>
                <input type="button" id="new_event_add_button" class="calendar_page_modal_btn" value="Добавить событие">
                <input type="button" id="change_event_button" class="calendar_page_modal_btn" value="Применить">
            </p>

{{--        </div>--}}
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


        <script src="{{asset('/calendarEvents/calendarEvents.js')}}"></script>
    @endpush
@endsection
