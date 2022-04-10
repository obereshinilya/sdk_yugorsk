<style>
    body { font-family: DejaVu Sans, sans-serif; font-size: 8px}
    .table th,
    .table td {
        padding: 0.75rem;
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
                <th style="width: 5px">Содержание выявленного нарушения</th>
                <th style="width: 10vh">Наименование элемента ОПО</th>
                <th style="width: 10vh">Уровень ПК</th>
                <th style="width: 10vh">Направление контроля</th>
                <th style="width: 10vh">Тяжесть последствий</th>
                <th style="width: 10vh">Отметка о повторяемости</th>
                <th style="width: 10vh">Мероприятие по устранению нарушения и причин его возникновения</th>
                <th style="width: 10vh">Срок устранения</th>
                <th style="width: 10vh">Статус нарушения</th>
                <th style="width: 10vh">Ответственный исполнитель</th>
            </tr>
            </thead>
            <tbody>
            @for($i=0; $i<count($data['desc_violation']); $i++)
                <tr>
                    <td>{{$data['desc_violation'][$i]}}</td>
                    <td>{{$data['name_obj'][$i]}}</td>
                    <td>{{$data['level_km'][$i]}}</td>
                    <td>{{$data['direction'][$i]}}</td>
                    <td>{{$data['severity_fatal'][$i]}}</td>
                    <td>{{$data['infi_repeat'][$i]}}</td>
                    <td>{{$data['plan_work'][$i]}}</td>
                    <td>{{$data['plan_date'][$i]}}</td>
                    <td>{{$data['violation_status'][$i]}}</td>
                    <td>{{$data['plan_pers'][$i]}}</td>
                </tr>
            @endfor
            </tbody>
        </table>
