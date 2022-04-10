
<!DOCTYPE html>
<html>
<head>
    <title>Календарь событий</title>
    <meta name="csrf-token" content="{{csrf_token()}}">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="../../../../../public/calendarEvents/fullcalendar/main.js"></script>
    <script src="../../../../../public/calendarEvents/fullcalendar/main.min.js"></script>
    <link rel="stylesheet" href="../../../../../public/calendarEvents/fullcalendar/main.css">

{{--    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.css" />--}}
{{--    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>--}}
{{--    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.js"></script>--}}

</head>
<body>
<div class="container">
    <br/>
    <h1 class="text-center text-primary"><u>Календарь событий</u></h1>
    <br/>
    <div id="calendar"></div>

</div >


<div class="overlay" data-close=""></div>



<div id="modal_1" class="dlg-modal dlg-modal-slide">
    <span class="closer" data-close=""></span>
    <h3>Создать новое событие</h3>
    <div id="calendar_event content">
        <select id="event_type_select">
            @foreach($types as $type)
                <option value="{{$type->id}}">{{$type->name}}</option>
            @endforeach
        </select>
        <br>
        <input type="text" name="event_name" id="event_name"  placeholder="Введите название события" /><br>
        <select id="event_dest_user">
            @foreach($users as $usr)
                <option value="{{$usr->id}}">{{$usr->name}}</option>
            @endforeach
        </select><br>
    </div>
</div>

<script>
    let opo_id={{$opo_id}};
</script>




<script>

    $.ajaxSetup({
        headers:{
            'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
        }
    });
    $(document).ready(function () {

        $.ajax({
            url:"/full-calendar/action",
            type:"POST",
            data:{
                start: '2021-04-04',
                end: '2021-07-05',
                opo: opo_id,
                type: 'get_data'
            },
            success:function(data)
            {
                console.log(data);
                $('#calendar').fullCalendar( 'addEventSource', data);
            }
        })


        //--------------ДИАЛОГ------------//
        const overlay = document.querySelector('.overlay'),
            mClose = document.querySelectorAll('[data-close]');

        let mStatus = false;

        for (let el of mClose) {
            el.addEventListener('click', modalClose);
        }

        document.addEventListener('keydown', modalClose);

        function modalShow(modal) {
            overlay.classList.remove('fadeOut');
            overlay.classList.add('fadeIn');

            modal.classList.remove('slideOutUp');
            modal.classList.add('slideInDown');

            mStatus = true;
        }

        function modalClose(event) {
            if (mStatus && ( event.type != 'keydown' || event.keyCode === 27 ) ) {
                for (let modal of modals) {
                    modal.classList.remove('slideInDown');
                    modal.classList.add('slideOutUp');
                }

                // закрываем overlay
                overlay.classList.remove('fadeIn');
                overlay.classList.add('fadeOut');

                mStatus = false;
            }
        }


        var calendar = $('#calendar').fullCalendar({
            monthNames: ['Январь','Февраль','Март','Апрель','Май','Июнь','Июль','Август','Сентябрь','Октябрь','Ноябрь','Декабрь'],
            monthNamesShort: ['Янв.','Фев.','Март','Апр.','Май','Июнь','Июль','Авг.','Сент.','Окт.','Ноя.','Дек.'],
            dayNames: ["Воскресенье","Понедельник","Вторник","Среда","Четверг","Пятница","Суббота"],
            dayNamesShort: ["ВС","ПН","ВТ","СР","ЧТ","ПТ","СБ"],
            buttonText: {
                prev: "Пред.",
                next: "След.",
                prevYear: "Пред.",
                nextYear: "След.",
                today: "Сегодня",
                month: "Месяц",
                week: "Неделя",
                day: "День"
            },
            firstDay: 1,


            editable:true,
            header:{
                left:'prev,next today',
                center:'title',
                right:'month,agendaWeek,agendaDay'
            },

            selectable:true,
            selectHelper: true,
            select:function(start, end, allDay)
            {


                var title = document.getElementById('event_name').value;
                let user_id={{ Auth::user()->id }};
                let event_type=document.getElementById('event_type_select').value;
                let dest_user_id=document.getElementById('event_dest_user').value;

                if(title)
                {
                    var start = $.fullCalendar.formatDate(start, 'Y-MM-DD HH:mm:ss');

                    var end = $.fullCalendar.formatDate(end, 'Y-MM-DD HH:mm:ss');

                    $.ajax({
                        url:"/full-calendar/action",
                        type:"POST",
                        data:{
                            title: title,
                            start: start,
                            end: end,
                            user: user_id,
                            event: event_type,
                            dest_user: dest_user_id,
                            opo: opo_id,
                            type: 'add'
                        },
                        success:function(data)
                        {
                            //calendar.fullCalendar('refetchEvents');
                            console.log(data)
                            alert("Event Created Successfully");
                        }
                    })
                }
            },
            editable:true,
            eventResize: function(event, delta)
            {
                var start = $.fullCalendar.formatDate(event.start, 'Y-MM-DD HH:mm:ss');
                var end = $.fullCalendar.formatDate(event.end, 'Y-MM-DD HH:mm:ss');
                var title = event.title;
                var id = event.id;
                $.ajax({
                    url:"/full-calendar/action",
                    type:"POST",
                    data:{
                        title: title,
                        start: start,
                        end: end,
                        id: id,
                        type: 'update'
                    },
                    success:function(response)
                    {
                        calendar.fullCalendar('refetchEvents');
                        alert("Event Updated Successfully");
                    }
                })
            },
            eventDrop: function(event, delta)
            {
                var start = $.fullCalendar.formatDate(event.start, 'Y-MM-DD HH:mm:ss');
                var end = $.fullCalendar.formatDate(event.end, 'Y-MM-DD HH:mm:ss');
                var title = event.title;
                var id = event.id;
                $.ajax({
                    url:"/full-calendar/action",
                    type:"POST",
                    data:{
                        title: title,
                        start: start,
                        end: end,
                        id: id,
                        type: 'update'
                    },
                    success:function(response)
                    {
                        calendar.fullCalendar('refetchEvents');
                        alert("Event Updated Successfully");
                    }
                })
            },

            eventClick:function(event)
            {
                if(confirm("Are you sure you want to remove it?"))
                {
                    var id = event.id;
                    $.ajax({
                        url:"/full-calendar/action",
                        type:"POST",
                        data:{
                            id:id,
                            type:"delete"
                        },
                        success:function(response)
                        {
                            calendar.fullCalendar('refetchEvents');
                            alert("Event Deleted Successfully");
                        }
                    })
                }
            }
        });

    });



    // function doModal() {
    //     const mOpen = document.querySelectorAll('[data-modal]');
    //     if (mOpen.length == 0) return;
    //
    //     const overlay = document.querySelector('.overlay'),
    //         modals = document.querySelectorAll('.dlg-modal'),
    //         mClose = document.querySelectorAll('[data-close]');
    //
    //     let mStatus = false;
    //
    //     for (let el of mOpen) {
    //         el.addEventListener('click', function (e) {
    //             let modalId = el.dataset.modal,
    //                 modal = document.getElementById(modalId);
    //             modalShow(modal);
    //         });
    //     }
    //
    //     for (let el of mClose) {
    //         el.addEventListener('click', modalClose);
    //     }
    //
    //     document.addEventListener('keydown', modalClose);
    //
    //     function modalShow(modal) {
    //         overlay.classList.remove('fadeOut');
    //         overlay.classList.add('fadeIn');
    //
    //         modal.classList.remove('slideOutUp');
    //         modal.classList.add('slideInDown');
    //
    //         mStatus = true;
    //     }
    //
    //     function modalClose(event) {
    //         if (mStatus && ( event.type != 'keydown' || event.keyCode === 27 ) ) {
    //             for (let modal of modals) {
    //                 modal.classList.remove('slideInDown');
    //                 modal.classList.add('slideOutUp');
    //             }
    //
    //             // закрываем overlay
    //             overlay.classList.remove('fadeIn');
    //             overlay.classList.add('fadeOut');
    //
    //             mStatus = false;
    //         }
    //     }
    //
    //
    // }

</script>

<style>
    /*--- CONTENT ---*/

    .overlay { opacity: 0; visibility: hidden; position:fixed; left: 0; right: 0; top: 0; bottom: 0; z-index: 5; background: rgba(0,0,0,0.87); }
    .dlg-modal { width: 100%; max-width: 570px; height: 300px; opacity: 0; visibility: hidden; text-align: center; position: fixed; left: 50%; z-index: 10; padding: 35px 36px; background: #fff; border-radius: 10px; -webkit-box-shadow: 0 0 20px rgba(0,0,0,0.85); box-shadow: 0 0 20px rgba(0,0,0,0.85); }
    .dlg-modal-slide { top: -20px; -webkit-transform: translate(-50%, -100%); transform: translate(-50%, -100%); visibility: visible; opacity: 1; }

    .closer { width: 40px; height: 40px; display: block; position: absolute; right: 10px; top: 10px; background: url('public/calendarEvents/cross.png') no-repeat; cursor: pointer; }
    .closer:hover { -webkit-transform: rotate(90deg); transform: rotate(90deg); }

    /* animation */
    .slideInDown, .slideOutUp { -webkit-animation-duration: 0.4s; animation-duration: 0.4s; -webkit-animation-timing-function: linear; animation-timing-function: linear; }

    @keyframes slideInDown {
        from { top: -20px; -webkit-transform: translate(-50%, -100%); transform: translate(-50%, -100%); }
        to { top: 50%; -webkit-transform: translate(-50%, -50%); transform: translate(-50%, -50%); }
    }
    .slideInDown { -webkit-animation-name: slideInDown; animation-name: slideInDown; top: 50%; transform: translate(-50%, -50%); }

    @keyframes slideOutUp {
        from { top: 50%; -webkit-transform: translate(-50%, -50%); transform: translate(-50%, -50%); }
        to { top: -20px; -webkit-transform: translate(-50%, -100%); transform: translate(-50%, -100%); }
    }
    .slideOutUp { -webkit-animation-name: slideOutUp; animation-name: slideOutUp; }

</style>
</body>
</html>
