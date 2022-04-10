<style>
    body { font-family: DejaVu Sans, sans-serif;
    font-size: 8px}
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
                <th>№</th>
                <th>Номер и дата акта проверки</th>
                <th>Пункт и НПА, положения которого нарушены</th>
                <th>Нарушение</th>
                <th>Мероприятия по устранению нарушений</th>
                <th>Срок устранения нарушения</th>
                <th>Дата устранения</th>
                <th>Ответственный за контроль устранения нарушений</th>
                <th>Причины невыполнения в срок</th>
                <th>Перенос срока</th>
                <th>Основание переноса срока</th>
                <th>Работники, привлеченные к ответственности за допущенное нарушение</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($data as $row)
                <tr>
                    <td>{{$row['id_in_calc']}}</td>
                    <td>{{$row['date_check_out']}}</td>
                    <td>{{$row['norm_act']}} Пункт {{$row['point_act']}}</td>
                    <td>{{$row['char_violation']}}</td>
                    <td>{{$row['name_event']}}</td>
                    <td>{{$row['time_violation']}}</td>
                    <td>{{$row['date_violation']}}</td>
                    <td>{{$row['name_f'].' '.$row['name_l'].' '.$row['name_p']}}</td>
                    <td>{{$row['reasons_nonpref']}}</td>
                    <td>{{$row['data_reasons']}}</td>
                    <td>{{$row['reasons_post']}}</td>
                    <td>{{$row['worker_violation']}}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
