<style>
    body { font-family: DejaVu Sans, sans-serif; font-size: 7px}
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
                <th rowspan="2" class="centered">№ п/п</th>
                <th rowspan="2" class="centered">Наименование ОПО</th>
                <th colspan="3" class="centered">I уровень</th>
                <th colspan="3" class="centered">II уровень</th>
                <th colspan="3" class="centered">III уровень</th>
                <th colspan="3" class="centered">IV уровень</th>
                <th rowspan="2" class="centered">ВСЕГО нарушений по ОПО</th>
            </tr>
            <tr>
                <th class="centered">Проверок</th>
                <th class="centered">Выявлено нарушений</th>
                <th class="centered">Устранено</th>
                <th class="centered">Проверок</th>
                <th class="centered">Выявлено нарушений</th>
                <th class="centered">Устранено</th>
                <th class="centered">Проверок</th>
                <th class="centered">Выявлено нарушений</th>
                <th class="centered">Устранено</th>
                <th class="centered">Проверок</th>
                <th class="centered">Выявлено нарушений</th>
                <th class="centered">Устранено</th>
            </tr>

            </thead>
            <tbody>
            @for($i=1; $i<count($data['name_opo'])+1; $i++)
                <tr>
                    <td>{{$i}}</td>
                    <td>{{$data['name_opo'][$i]}}</td>
                    <td></td>
                    <td>{{$data['level_1_all'][$i]}}</td>
                    <td>{{$data['level_1_ok'][$i]}}</td>
                    <td></td>
                    <td>{{$data['level_2_all'][$i]}}</td>
                    <td>{{$data['level_2_ok'][$i]}}</td>
                    <td></td>
                    <td>{{$data['level_3_all'][$i]}}</td>
                    <td>{{$data['level_3_ok'][$i]}}</td>
                    <td></td>
                    <td>{{$data['level_4_all'][$i]}}</td>
                    <td>{{$data['level_4_ok'][$i]}}</td>
                    <td>{{$data['opo_all'][$i]}}</td>
                </tr>
            @endfor

            </tbody>
        </table>
