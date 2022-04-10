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
                <th rowspan="2" class="centered">Наименование ОПО</th>
                <th rowspan="2" class="centered">Элемент ОПО</th>
                <th rowspan="2" class="centered">Наименование повторного несоответствия (требования законодательства)</th>
                <th colspan="4" class="centered">Выявлено при проведении контрольных мероприятий</th>
                <th rowspan="2" class="centered">Всего за период</th>
                <th rowspan="2" class="centered">% устранения</th>
                <th rowspan="2" class="centered">% от общего количества выявленых за год</th>
            </tr>
            <tr>
                <th class="centered">I уровень</th>
                <th class="centered">II уровень</th>
                <th class="centered">III уровень</th>
                <th class="centered">IV уровень</th>
            </tr>
            </thead>
            <tbody>
            @foreach($data as $dat)
                <tr>
                    <td style="text-align: center">{{$dat['name_opo']}}</td>
                    <td style="text-align: center">{{$dat['name_elem']}}</td>
                    <td style="text-align: center">{{$dat['name_violation']}}</td>
                    <td style="text-align: center">{{$dat['num_1_level']}}</td>
                    <td style="text-align: center">{{$dat['num_2_level']}}</td>
                    <td style="text-align: center">{{$dat['num_3_level']}}</td>
                    <td style="text-align: center">{{$dat['num_4_level']}}</td>
                    <td style="text-align: center">{{$dat['num_all']}}</td>
                    <td style="text-align: center">{{$dat['percent_ok']}}%</td>
                    <td style="text-align: center">{{$dat['percent_ok_all']}}%</td>
                </tr>
            @endforeach
            </tbody>
        </table>
