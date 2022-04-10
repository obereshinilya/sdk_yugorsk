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

                @foreach($data as $dat)
                    <tr>
                        <td style="text-align: center">{{$dat['id_in_calc']}}</td>
                        <td style="text-align: center">{{$dat['name_opo']}}</td>
                        <td style="text-align: center">{{$dat['num_pk_1']}}</td>
                        <td style="text-align: center">{{$dat['level_1_all']}}</td>
                        <td style="text-align: center">{{$dat['level_1_ok']}}</td>
                        <td style="text-align: center">{{$dat['num_pk_2']}}</td>
                        <td style="text-align: center">{{$dat['level_2_all']}}</td>
                        <td style="text-align: center">{{$dat['level_2_ok']}}</td>
                        <td style="text-align: center">{{$dat['num_pk_3']}}</td>
                        <td style="text-align: center">{{$dat['level_3_all']}}</td>
                        <td style="text-align: center">{{$dat['level_3_ok']}}</td>
                        <td style="text-align: center">{{$dat['num_pk_4']}}</td>
                        <td style="text-align: center">{{$dat['level_4_all']}}</td>
                        <td style="text-align: center">{{$dat['level_4_ok']}}</td>
                        <td style="text-align: center">{{$dat['opo_all']}}</td>
                    </tr>
                @endforeach

                </tbody>

            </table>
