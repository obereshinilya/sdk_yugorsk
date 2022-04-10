var calendar;
var action=''
var dateOptions={day:'numeric', month:'numeric',year:'numeric'};
var add_maintenance_modal;
document.addEventListener('DOMContentLoaded', function() {
    $.ajaxSetup({
        headers:{
            'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
        }
    });

    var add_maintenance_dialog_content=document.getElementById('new_maintenance_form')
    add_maintenance_modal=new ModalWindow('', add_maintenance_dialog_content, AnimationsTypes['slideIn'], true, true)


    var calendarEl = document.getElementById('calendar');
    calendar = new FullCalendar.Calendar(calendarEl,
        {
            displayEventTime:false,
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
            dayMaxEventRows : true,
            views: {
                timeGrid: {
                    dayMaxEventRows: 5
                }
            },
            headerToolbar: {
                left: 'prev,next today',
                center: 'title',
                right: 'add_new_value,dayGridMonth,timeGridWeek,listWeek'
            },
            selectable: true,
            customButtons: {
                add_new_value:{
                    text:'Добавить',
                    click: function() {
                        add_maintenance_modal.change_header_text('Добавить новое техническое обслуживание')
                        clearModal()
                        $('.form_btn').removeClass('resize')
                        $('#delete_maintenance_button').hide()
                        $('#add_new_maintenance_button').text('Добавить')
                        try{
                            $('#start_date').data("DateTimePicker").date()
                            $('#end_date').data("DateTimePicker").date()
                        }
                        catch (err){
                            console.log(err);
                            $('#start_date').datetimepicker({
                                minDate:new Date(),
                                locale: 'ru',
                                format: 'DD.MM.YYYY'
                            });
                            $('#end_date').datetimepicker({
                                minDate:new Date(),
                                locale: 'ru',
                                format: 'DD.MM.YYYY'
                            });
                        }
                        action='add'
                        add_maintenance_modal.show()

                    }
                }
            },
            events:function (fetchInfo, callback) {
                var request_type=''
                if (calendar_type=='elem'){
                    request_type='get_data_elem'
                }
                else if (calendar_type=='opo'){
                    request_type='get_data_opo'
                }
                console.log({
                    start: new Date(FullCalendar.formatDate(fetchInfo.start)).toISOString().slice(0,10),
                    end: new Date(FullCalendar.formatDate(fetchInfo.end)).toISOString().slice(0,10),
                    by_id: by_id,
                    type: request_type
                })
                $.ajax({
                    url:"/maintenance/action",
                    type:"POST",
                    data:{
                        start: new Date(FullCalendar.formatDate(fetchInfo.start)).toISOString().slice(0,10),
                        end: new Date(FullCalendar.formatDate(fetchInfo.end)).toISOString().slice(0,10),
                        by_id: by_id,
                        type: request_type
                    },
                    success:function(data)
                    {
                        console.log(data);
                        callback(data);
                    }
                })
            },
            eventClick:function (info){
                action='change'

                $('.form_btn').addClass('resize')
                $('#delete_maintenance_button').show()
                $('#obj_id_input').val(info.event.id)
                var end_date=new Date(info.event.end.setDate(info.event.end.getDate()-1));
                try{
                    $('#start_date').data("DateTimePicker").date(info.event.start)
                    $('#end_date').data("DateTimePicker").date(end_date)
                }
                catch (e){
                    var minDate=new Date();
                    minDate.setDate(minDate.getDate()-1)
                    $('#start_date').datetimepicker({
                        minDate:info.event.start,
                        locale: 'ru',
                        format: 'DD.MM.YYYY',
                        date:info.event.start
                    });
                    $('#end_date').datetimepicker({
                        minDate:info.event.start,
                        locale: 'ru',
                        format: 'DD.MM.YYYY',
                        date:end_date
                    });
                }

                $('#add_new_maintenance_button').text('Изменить')

                if (calendar_type=='opo'){
                    // console.log(info.event.extendedProps['obj_id'])
                    $('#obj_id_select').val(info.event.extendedProps['obj_id']).change();
                }
                add_maintenance_modal.change_header_text(info.event.title)
                add_maintenance_modal.show()
                // modalShow(add_maintenance_dialog)
            }

        });
    calendar.render();




    $('#end_date').on('dp.change', function(e){
        try{
            $('#end_date').data("DateTimePicker").minDate($('#start_date').data("DateTimePicker").date());
        }
        catch (err){
            console.log(err);
        }
    });
    $('#start_date').on('dp.change', function(e){
        try{
            $('#end_date').data("DateTimePicker").minDate(e.date);
        }
        catch (err){
            console.log(err);
        }
    });

    document.getElementById('delete_maintenance_button').addEventListener('click', ()=>{
        $.ajax({
            url:"/maintenance/action",
            type:"POST",
            data:{
                id:$('#obj_id_input').val(),
                type:'delete_elem'
            },
            success:function(responce)
            {
                if (responce==1){
                    add_maintenance_modal.close()
                    calendar.getEventById($('#obj_id_input').val()).remove()
                }
                else{
                    console.log(responce);
                }
            }
        })
    });


})

function clearModal(){
    $('#start_date').val('')
    $('#end_date').val('')
    $('#maintenance_title').val('')
}

function add_maintenance(form){
    console.log(form.end_date.value)
    var end_date=new Date(form.end_date.value.split('.')[2]+'-'+form.end_date.value.split('.')[1]+'-'+form.end_date.value.split('.')[0]);

    end_date.setDate(end_date.getDate() + 1);
    console.log(end_date)
    var data={
        data:{
            id:form.obj_id_input.value,
            title:form.maintenance_title.value,
            start_date:form.start_date.value,
            end_date:end_date.toLocaleDateString('ru-RU', dateOptions)
        },
        type: action
    }
    if (calendar_type=='opo'){
        data['data']['obj_id']=$('#obj_id_select').children("option:selected").val();
    }
    else if (calendar_type=='elem'){
        data['data']['obj_id']=by_id;
    }
    console.log(data)
    $.ajax({
        url:"/maintenance/action",
        type:"POST",
        data:data,
        success:function(responce)
        {
            console.log(responce)
            if (responce==1){
                add_maintenance_modal.close();
                calendar.refetchEvents();
            }
        }
    })
    return false;
}




// function close_dialog(){
//     var add_maintenance_dialog=document.getElementById('add_new_maintenance_dialog')
//     add_maintenance_dialog.close();
//
//     overlay.className='overlay fadeOut';
// }
