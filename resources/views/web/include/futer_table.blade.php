<div class="top_table">

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

{{--                <td class="td_button"><a href="index.html#">За сутки</a></td>--}}
            </tr>
            </tbody>
        </table>
    </div>

{{--    <div class="top_table_inside" id="top_table_inside">--}}
{{--        <table>--}}
{{--            <tbody>--}}
{{--            </tbody>--}}
{{--        </table>--}}
{{--    </div>--}}

    <div class="top_table_inside" id="footer_table">

    <table>

        <tbody>

            @foreach ($jas_opo as $value)
            <tr>
              <td class="td_date">{{date('d-m-Y h:m', strtotime($value->data))}}</td>
              <td class="td_status">{{$value->level}}</td>
              <td class="td_opo">{{$value->jas_to_opo->descOPO}}</td>
              <td class="td_element">{{$value->jas_to_elem->nameObj}}. (Элемент объекта ОПО {{$value->jas_to_opo->descOPO}})</td>
              <td class="td_number">{{$value->status}}</td>
              <td class="td_event">{{$value->name}}</td>
            </tr>
            @endforeach


        </tbody>
    </table>

    </div>
</div>

