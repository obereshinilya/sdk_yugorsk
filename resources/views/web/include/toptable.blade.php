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
            <td class="td_btn "><a href="{{ url('/jas_full?sort=data&direction=desc') }}">Открыть полностью</a></td>
        </tr>
        </tbody>
    </table>
</div>


<div class="top_table_inside" id="top_table_inside">
    <table>
        <tbody>
        <tr>
            <td class="td_date">18-07-2022 18:00</td>
            <td class="td_status">C2</td>
            <td class="td_opo">УМГ</td>
            <td class="td_element">Уренгой-Новопсков 1262.6-1263.3</td>
            <td class="td_number">Квитировано</td>
            <td class="td_event">До окончания действия экспертизы < 365 дней</td>
        </tr>
{{--        //Сюда нарожать строк из будущего журнала событий--}}
        </tbody>
    </table>
</div>
