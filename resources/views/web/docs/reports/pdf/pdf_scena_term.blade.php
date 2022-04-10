<style>
    body { font-family: DejaVu Sans, sans-serif; font-size: 11px}
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
<h3 class="text-muted" style="text-align: center" >{{$title}}</h3>
        <table style="border-collapse: collapse;" class="table table-hover">
            <thead>
            <tr>
                <th style="width: 25vh">Дата и время события</th>
                <th style="width: 25vh">Наименование ОПО</th>
                <th style="width: 25vh">Наименование элемента ОПО</th>
                <th style="width: 25vh">Наименование типового сценария в соответствии с матрицей</th>
                <th style="width: 25vh">Класс события</th>
                <th style="width: 25vh">Статус</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($data as $row)
                <tr>
                    <td>{{$row['date_event']}}</td>
                    <td>{{$row['name_opo']}}</td>
                    <td>{{$row['name_obj']}}</td>
                    <td>{{$row['name_scena']}}</td>
                    <td>{{$row['class_event']}}</td>
                    <td>{{$row['status']}}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
