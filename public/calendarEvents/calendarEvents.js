// import "/public/js/modals_function";

document.addEventListener('DOMContentLoaded', function() {

    // document.getElementById('calendar').style.height=window.innerHeight-500;
    $.ajaxSetup({
        headers:{
            'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
        }
    });
    var new_event_content=document.getElementById('new_calendar_event_content')
    var event_info_content=document.getElementById('calendar_event_content')
    var event_modal=new ModalWindow('', new_event_content, AnimationsTypes['slideIn'])

    var dateOptions={day:'numeric', month:'numeric',year:'numeric'};
    var timeOptions={hour:"numeric", minute: "numeric"}

    var atrr_buffer={}


    function clearContent(){
        $('#new_event_title').val('');
        $('#new_event_description').val('');
        $('#new_event_start').val('');
        $('#new_event_end').val('');
        $('#event_description').val('');
        $('#event_start_datetime').val('');
        $('#event_end_datetime').val('');
        $('#event_type').val('');
        $('#event_dest_user').val('');
        $('#event_create_user').val('');
        $('#event_status').val('');
    }

    //-------------Календарь----------------//



    var calendarEl = document.getElementById('calendar');
    var calendar = new FullCalendar.Calendar(calendarEl,
        {
        themeSystem : 'sandstone',
        firstDay: 1,
        timeZone: 'local',
        initialView: 'dayGridMonth',
        locale:{
            code: 'ru',
            week: {
                dow: 1, // Monday is the first day of the week.
                doy: 4, // The week that contains Jan 4th is the first week of the year.
            },
            buttonText: {
                prev: 'Пред',
                next: 'След',
                today: 'Сегодня',
                month: 'Месяц',
                week: 'Неделя',
                day: 'День',
                list: 'Повестка дня',
            },
            weekText: 'Нед',
            allDayText: 'Весь день',
            moreLinkText: function(n) {
                return '+ ещё ' + n
            },
            noEventsText: 'Нет событий для отображения',
        },

        events: function (fetchInfo, callback){
            $.ajax({
                url:"/full-calendar/action",
                type:"POST",
                data:{
                    start: new Date(FullCalendar.formatDate(fetchInfo.start)).toISOString().slice(0,10),
                    end: new Date(FullCalendar.formatDate(fetchInfo.end)).toISOString().slice(0,10),
                    opo: opo_id,
                    type: 'get_data'
                },
                success:function(data)
                {
                    //console.log(data);
                    callback(data);
                }
            })
        },
        dayMaxEventRows : true,
        views: {
            timeGrid: {
                dayMaxEventRows: 5
            }
        },
        customButtons: {
            newEventBtn:{
                text:'Добавить событие',
                click: function() {
                    clearContent()
                    $('#new_event_add_button').show();
                    $('#change_event_button').hide();

                    var event_start=$('#new_event_start')
                    var event_end=$('#new_event_end')
                    // console.log(event_start)
                    // console.log(event_end)
                    event_start.datetimepicker({
                        minDate:new Date(),
                        locale: 'ru'
                    });

                    event_end.datetimepicker({
                        minDate:new Date(),
                        locale: 'ru'
                    });


                    // var modal = document.getElementById("new_calendar_event_modal");
                    // modalShow(modal);

                    event_modal.change_header_text('Новое событие')
                    event_modal.change_content(new_event_content)
                    event_modal.show()
                }
            }
        },
        headerToolbar: {
            left: 'prev,next today',
            center: 'title',
            right: 'newEventBtn,dayGridMonth,timeGridWeek,listWeek'
        }, selectable: true,
        select:function(selectionInfo){
            clearContent();
            $('#new_event_add_button').show();
            $('#change_event_button').hide();
            // $('#new_event_modal_title').text('Новое событие');
            var today=new Date();
            // console.log(selectionInfo.startStr)
            // console.log(today)
            if (selectionInfo.start>=new Date(today.getFullYear(), today.getMonth(), today.getDate())){
                var event_start=$('#new_event_start')
                var event_end=$('#new_event_end')

                if (selectionInfo.start>today){
                    event_start.val(selectionInfo.start.toLocaleDateString('ru-RU',dateOptions) +' '+selectionInfo.start.toLocaleTimeString('ru-RU',timeOptions));
                }
                else {
                    event_start.val(today.toLocaleDateString('ru-RU',dateOptions) +' '+today.toLocaleTimeString('ru-RU',timeOptions));
                }
                event_end.val(selectionInfo.end.toLocaleDateString('ru-RU',dateOptions) +' '+selectionInfo.end.toLocaleTimeString('ru-RU',timeOptions))
                /* инициализируем Datetimepicker */
                var minDate=new Date();
                minDate.setHours(minDate.getHours())
                minDate.setMinutes(minDate.getMinutes()-1)
                event_start.datetimepicker({
                    minDate:minDate,
                    locale: 'ru'
                    // sideBySide:true
                });

                event_end.datetimepicker({
                    minDate:new Date(),
                    locale: 'ru'
                    // sideBySide:true
                });


                // var modal = document.getElementById("new_calendar_event_modal");
                // modalShow(modal);
                event_modal.change_header_text('Новое событие')
                event_modal.change_content(new_event_content)
                event_modal.show()
            }

        },

        dayHeaderDidMount :function (arg){
            if (arg.view.type=="listWeek"){
                //Имена столбцов
                if (typeof $(".fc-list-column-names")[0] =='undefined'){
                    var tableColumnsNames=document.createElement('tr')
                    tableColumnsNames.className='fc-list-column-names'

                    var ColumnsName=['Время', '', 'Событие', 'Описание', 'Тип события', 'Ответственный', 'Создал', 'Статус']
                    for(var i=0; i<ColumnsName.length; i++) {
                        var coll_elem=document.createElement('td');
                        coll_elem.className='fc-list-event-column-name';
                        coll_elem.textContent=ColumnsName[i];
                        tableColumnsNames.append(coll_elem);
                    }

                    $(".fc-list-day")[0].insertAdjacentElement("beforebegin", tableColumnsNames)
                }

            }

        },


        //Вызывается сразу после добавления элемента в DOM
        eventDidMount: function(info) {
            if (info.view.type=="listWeek"){

                var tableHeader = $(".fc-list-table th");
                var toInject=[]
                toInject.push(info.event.extendedProps['description']);
                toInject.push(info.event.extendedProps['event_type']);
                toInject.push(info.event.extendedProps['dest_user']);
                toInject.push(info.event.extendedProps['creator_user']);
                toInject.push(info.event.extendedProps['status']);

                for(var i=0; i<toInject.length; i++) {
                    var coll_elem=document.createElement('td');
                    coll_elem.className='fc-list-event-other';
                    coll_elem.textContent=toInject[i];
                    info.el.append(coll_elem);
                }
                tableHeader.attr("colspan", toInject.length+3);
            }
            //info.el.setAttribute('event_id', )
        },
        eventClick: function(info) {
            clearContent()

            // console.log(info.event)
            var confirm_btn=$('#event_confirm_btn');
            var delete_btn=$('#delete_this_event_btn');
            var change_btn=$('#change_this_event_btn');
            confirm_btn.show()

            $('#current_event_id').val(info.event.id)
            // console.log(info.event.id)
            $('#event_title').val(info.event.title);
            $('#event_title').text('Событие: '+info.event.title);

            $('#event_description').val(info.event.extendedProps.description);
            $('#event_description').text('Описание: '+info.event.extendedProps.description);

            $('#event_start_datetime').val(info.event.start);
            $('#event_start_datetime').text('Начало: '+info.event.start.toLocaleString());

            $('#event_end_datetime').val(info.event.end);
            $('#event_end_datetime').text('Конец: '+info.event.end.toLocaleString());

            $('#event_type').val(info.event.extendedProps.event_type_id);
            $('#event_type').text('Тип события: '+info.event.extendedProps.event_type);

            $('#event_dest_user').val(info.event.extendedProps.dest_user_id);
            $('#event_dest_user').text('Ответственный: '+info.event.extendedProps.dest_user);

            $('#event_create_user').text('Создал: '+info.event.extendedProps.creator_user);
            $('#event_status').text('Статус: '+info.event.extendedProps.status);

            // document.getElementById('event_description').innerText='Описание: '+info.event.extendedProps.description;
            // document.getElementById('event_start_datetime').innerText='Начало: '+info.event.start.toLocaleString();
            // document.getElementById('event_end_datetime').innerText='Конец: '+info.event.end.toLocaleString();
            // document.getElementById('event_type').innerText='Тип события: '+info.event.extendedProps.event_type;
            // document.getElementById('event_dest_user').innerText='Ответственный: '+info.event.extendedProps.dest_user;
            // document.getElementById('event_create_user').innerText='Создал: '+info.event.extendedProps.creator_user;
            // document.getElementById('event_status').innerText='Статус: '+info.event.extendedProps.status;

            // console.log(info.event.extendedProps.dest_user_id)
            // console.log(user_id)
            if (info.event.extendedProps.status_id==1){
                if (user_id==info.event.extendedProps.dest_user_id){
                    confirm_btn.val('Начать')
                }
                else{
                    confirm_btn.hide();
                }

            }
            else if (info.event.extendedProps.status_id==3 || info.event.extendedProps.status_id==4){
                confirm_btn.hide();

            }
            else if (info.event.extendedProps.status_id==2){
                if (user_id==info.event.extendedProps.dest_user_id){
                    confirm_btn.val('Выполнено')
                }
                else{
                    confirm_btn.hide();
                }

            }
            if (user_id==info.event.extendedProps.creator_user_id){
                delete_btn.show();
                if (info.event.extendedProps.status_id==3 || info.event.extendedProps.status_id==4){
                    change_btn.hide();
                }
                else{
                    change_btn.show();
                }
            }
            else{
                delete_btn.hide();
            }

            atrr_buffer['title']=info.event.title;
            atrr_buffer['event_id']=info.event.id;
            atrr_buffer['description']=info.event.extendedProps.description;
            atrr_buffer['event_start']=info.event.start;
            atrr_buffer['event_end']=info.event.end;
            atrr_buffer['event_type']=info.event.extendedProps.event_type_id;
            atrr_buffer['dest_user']=info.event.extendedProps.dest_user_id;
            atrr_buffer['creator_user']=info.event.extendedProps.creator_user;
            atrr_buffer['status']=info.event.extendedProps.status;

            event_modal.change_header_text('Событие: '+info.event.title)
            event_modal.change_content(event_info_content)
            event_modal.show()

        }



    });





    calendar.render();

    $('#new_event_end').on('dp.change', function(e){
        try{
            $('#new_event_end').data("DateTimePicker").minDate($('#new_event_start').data("DateTimePicker").date());
        }
        catch (err){
            console.log(err);
        }
    });
    $('#new_event_start').on('dp.change', function(e){
        try{
            $('#new_event_end').data("DateTimePicker").minDate(e.date);
        }
        catch (err){
            console.log(err);
        }
    });

    document.getElementById('new_event_add_button').addEventListener('click', ()=>
    {
        var event_start=$('#new_event_start')
        var event_end=$('#new_event_end')

        var data={
            data:{
                creator_user_id: user_id,
                dest_user_id:$('select[id=new_event_dest_user] option').filter(':selected').val(),
                event_type:$('select[id=new_event_type] option').filter(':selected').val(),
                title:$('#new_event_title').val(),
                opo_id:opo_id,
                start_datetime: event_start.val(),
                end_datetime:event_end.val(),
                description:$('#new_event_description').val(),
            },
            type: 'add'
        }

        $.ajax({
            url:"/full-calendar/action",
            type:"POST",
            data:data,
            success:function(responce)
            {
                if (responce==='1'){
                    event_modal.close()
                    calendar.refetchEvents();
                    clearContent();
                }
            }
        })

    });

    document.getElementById('event_confirm_btn').addEventListener('click', ()=>{
        $.ajax({
            url:"/full-calendar/action",
            type:"POST",
            data:{
                id:$('#current_event_id').val(),
                type: 'change_status'
            },
            success:function(responce)
            {
                if (responce==='1'){
                    event_modal.close()
                    calendar.refetchEvents();
                    clearContent();
                }
                else{
                    console.log(responce)
                }
            }
        })
    });

    document.getElementById('delete_this_event_btn').addEventListener('click', ()=>{
       $.ajax({
           url:'/full-calendar/action',
           type:'POST',
           data:{
               id:$('#current_event_id').val(),
               type: 'delete'
           },
           success:function (responce){
               // console.log(responce)
               if (responce==='1'){
                   event_modal.close()
                   calendar.refetchEvents();
                   clearContent();
               }
               else{
                   console.log(responce);
               }
           }
       })
    });

    document.getElementById('change_this_event_btn').addEventListener('click', ()=>{
        // clearContent();
        //console.log($('#event_title').val())
        event_modal.change_header_text('Изменить событие')
        event_modal.change_content(new_event_content)
        event_modal.show()

        // $('#current_event_id').val(info.event.id)

        $('#new_event_title').val(atrr_buffer['title']);
        $('#new_event_description').val(atrr_buffer['description']);


        var start_time=atrr_buffer['event_start'].toLocaleDateString('ru-RU',dateOptions) +' '+atrr_buffer['event_start'].toLocaleTimeString('ru-RU',timeOptions);
        var end_time=atrr_buffer['event_end'].toLocaleDateString('ru-RU',dateOptions) +' '+atrr_buffer['event_end'].toLocaleTimeString('ru-RU',timeOptions);

        $('#new_event_start').val(start_time);
        $('#new_event_end').val(end_time);
        $('#new_event_type').val(atrr_buffer['event_type']);
        $('#new_event_dest_user').val(atrr_buffer['dest_user']);

        $('#new_event_add_button').hide();
        $('#change_event_button').show();


        var minDate=new Date();
        minDate.setDate(minDate.getDate()-1)
        minDate.setHours(23)
        minDate.setMinutes(59)
        // console.log(minDate)
        $('#new_event_start').datetimepicker({
            minDate:minDate,
            locale: 'ru',
            sideBySide:true,
            date:atrr_buffer['event_start']
        });

        // console.log($('#event_start_datetime').val().toLocaleString())
        $('#new_event_end').datetimepicker({
            minDate:minDate,
            locale: 'ru',
            sideBySide:true,
            date:atrr_buffer['event_end']
        });
        // $('#new_event_modal_title').text('Изменить событие');
        // var modal = document.getElementById("new_calendar_event_modal");
        // modalShow(modal);


    });

    document.getElementById('change_event_button').addEventListener('click', ()=>{
        var event_start=$('#new_event_start')
        var event_end=$('#new_event_end')
        console.log(atrr_buffer['event_id'])

        var data={
            event_id: atrr_buffer['event_id'],
            dest_user_id:$('select[id=new_event_dest_user] option').filter(':selected').val(),
            event_type:$('select[id=new_event_type] option').filter(':selected').val(),
            title:$('#new_event_title').val(),
            start_datetime: event_start.val(),
            end_datetime:event_end.val(),
            description:$('#new_event_description').val(),
            type: 'change'
        }

        $.ajax({
            url:"/full-calendar/action",
            type:"POST",
            data:data,
            success:function(responce)
            {
                console.log(responce)
                if (responce==='1'){
                    // $('#new_event_modal_title').text('Новое событие');
                    // modalClose();
                    // event_modal.change_content(new_event_content)
                    event_modal.close();
                    calendar.refetchEvents();
                    clearContent();
                }
            }
        })
    });
})

