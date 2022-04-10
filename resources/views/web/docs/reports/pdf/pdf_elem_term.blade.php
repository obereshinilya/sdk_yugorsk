<style>
    body { font-family: DejaVu Sans, sans-serif; font-size: 10px}
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
                    <th style="width: 25vh">Наименование ОПО</th>
                    <th style="width: 25vh">Наименование элемента ОПО</th>
                    <th style="width: 25vh">Интегральный показатель состояния ПБ Элемента ОПО</th>
                    <th style="width: 25vh">Обобщенный показатель состояния ПБ элемента ОПО по комплексным сценариям</th>
                    <th style="width: 25vh">Обобщенный показатель технического риска ПБ элемента ОПО</th>
                    <th style="width: 25vh">Обобщенный показатель нарушения регламентных значений и превышения пределов безопасности технологического процесса</th>
                </tr>
                </thead>
                <tbody>

                @foreach($data as $row)
                    <tr>
                        <td>{{$row['name_opo']}}</td>
                        <td>{{$row['name_obj']}}</td>
                        <td>{{$row['IP_obj']}}</td>
                        <td>{{$row['OP_pb']}}</td>
                        <td>{{$row['OP_tech_risk']}}</td>
                        <td>{{$row['OP_reg']}}</td>
                    </tr>
                @endforeach

                </tbody>

            </table>
