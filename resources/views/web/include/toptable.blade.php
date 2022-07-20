<script>
    var tablePage=true;
</script>

<div class="table_head_block">
    <img alt="" src="{{asset('assets/images/t_left.svg')}}" class="table_left_corner">
    <table>
        <tbody>
        <tr>
            <td class="td_date">Дата</td>
            <td class="td_status">Статус</td>
            <td class="td_opo">ОПО</td>
            <td class="td_element">Элемент ОПО</td>
            <td class="td_number">Состояние</td>
            <td class="td_event">Событие</td>
            <td class="td_btn "><a href="{{ url('/jas_full') }}">Открыть полностью</a></td>
        </tr>
        </tbody>
    </table>
</div>


<div class="top_table_inside" id="top_table_inside">
    <table id="itemInfoTable">
        <tbody>
{{--        //Сюда нарожать строк из будущего журнала событий--}}
        </tbody>
    </table>
</div>

<script>

    $(document).ready(function (){
        getTableData();
        setInterval(getTableData, 10000);
    });

    function getTableData(type=null, data=null) {

        $.ajax({
            url:'/jas_in_top_table',
            // data: 1,
            type:'GET',
            success:(res)=>{
                // console.log(res[0]['id'])
                var table_body=document.getElementById('itemInfoTable').getElementsByTagName('tbody')[0]
                table_body.innerText=''
                var check = 'Новое'
                for (var i = 0; i<res.length; i++){
                    if (res[i]['check']){
                        check = 'Просмотрено'
                    } else {
                        check = 'Новое'
                    }
                    var tr=document.createElement('tr')
                    tr.innerHTML+=`<td class="td_date">${res[i]['date'].split('.')[0]}</td>`
                    tr.innerHTML+=`<td class="td_status">${res[i]['status']}</td>`
                    tr.innerHTML+=`<td class="td_opo">${res[i]['opo']}</td>`
                    tr.innerHTML+=`<td class="td_element">${res[i]['elem_opo']}</td>`
                    tr.innerHTML+=`<td class="td_number">${check}</td>`
                    tr.innerHTML+=`<td class="td_event">${res[i]['sobitie']}</td>`

                    table_body.appendChild(tr);
                }
            }
        })
    }

</script>
