<style>
    body { font-family: DejaVu Sans, sans-serif; }
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
<h2 class="text-muted" style="text-align: center" >{{$data['title']}}</h2>
        <table style="border-collapse: collapse;" class="table table-hover">
            <thead>
            <tr>
                <th style="width: 25vh">№</th>
                <th style="width: 25vh">Наименование ОПО</th>
                <th style="width: 25vh">Регистрационный номер ОПО</th>
                <th style="width: 25vh">Интегральный показатель ОПО</th>
                <th style="width: 25vh">Статус</th>
                <th style="width: 25vh">Дата отправки</th>
                <th style="width: 25vh">Время отправки</th>
            </tr>
            </thead>
            <tbody>
            @for($i=0; $i<count($data['fullDescOPO']); $i++)
                <tr>
                    <td>{{$data['id'][$i]}}</td>
                    <td>{{$data['fullDescOPO'][$i]}}</td>
                    <td>{{$data['regNumOPO'][$i]}}</td>
                    <td>{{$data['ip_opo'][$i]}}</td>
                    <td>{{$data['status'][$i]}}</td>
                    <td>{{$data['date'][$i]}}</td>
                    <td>{{$data['time'][$i]}}</td>
                </tr>
            @endfor

            </tbody>

        </table>
