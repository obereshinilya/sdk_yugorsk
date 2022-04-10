<style>
    body { font-family: DejaVu Sans, sans-serif; font-size: 8px}
    .table th,
    .table td {
        padding: 0.01rem;
        vertical-align: top;
        border-top: 1px solid #dee2e6;
        border: 1px solid black; /* Параметры рамки */
    }
    .table-hover tbody tr:hover {
        color: #212529;
        background-color: rgba(0, 0, 0, 0.075);
    }
</style>
<h2 class="text-muted" style="text-align: center" >{{$title}}</h2>
        <table style="border-collapse: collapse;" class="table table-hover">
            <thead>
            <tr>
                <th rowspan="2" class="centered">Наименование элемента ОПО</th>
                <th colspan="7" class="centered">Показатели безопасности функционирования ОПО</th>
                <th rowspan="2" class="centered">Обобщенный показатель безопасности функционирования ОПО</th>
                <th rowspan="2" class="centered">Показатель безаварийности ОПО</th>
                <th rowspan="2" class="centered">Показатель готовности организации и персонала ОПО к локализации аварий и инцидентов</th>
                <th rowspan="2" class="centered">Обобщенный показатель результативности АПК ОПО</th>
            </tr>
            <tr>
                <th class="centered">Показатель наличия "критичных" несоответствий</th>
                <th class="centered">Показатель устраняемости нарушений</th>
                <th class="centered">Показатель результативности контрольных процедур ПК</th>
                <th class="centered">Показатель наличия повторно выявляемых несоответствий</th>
                <th class="centered">Показатель эффективности корректирующих и предупреждающих действий </th>
                <th class="centered">Показатель результативности ПК, в сравнении с внешним производственным контролем</th>
                <th class="centered">Показатель охвата элементов ОПО контрольными процедурами</th>
            </tr>
            </thead>
            <tbody>
            @for ($i=0; $i<count($data['name_opo']); $i++)
                <tr>
                    <td>{{$data['name_opo'][$i]}}</td>
                    <td>{{$data['p_kr'][$i]}}</td>
                    <td>{{$data['p_un'][$i]}}</td>
                    <td>{{$data['p_kp'][$i]}}</td>
                    <td>{{$data['p_pn'][$i]}}</td>
                    <td>{{$data['p_kd'][$i]}}</td>
                    <td>{{$data['p_vp'][$i]}}</td>
                    <td>{{$data['p_ok'][$i]}}</td>
                    <td>{{$data['r_bf'][$i]}}</td>
                    <td>{{$data['r_ab'][$i]}}</td>
                    <td>{{$data['r_go'][$i]}}</td>
                    <td>{{$data['o_pk'][$i]}}</td>
                </tr>

            @endfor


            </tbody>

        </table>
