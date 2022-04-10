<style>
    body { font-family: DejaVu Sans, sans-serif; }
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
        <table style="border-collapse: collapse; table-layout: fixed; width: 65 rem" class="table table-hover">
            <thead>
            <tr>
                <th rowspan="2" style="width:13%;" class="centered">Наименование ОПО</th>
                <th rowspan="2" style="width:8%;" class="centered">Элемент ОПО</th>
                <th rowspan="2" style="width:21%;" class="centered">Наименование повторного несоответствия (требования законодательства)</th>
                <th colspan="4" style="width:30%;" class="centered">Выявлено при проведении контрольных мероприятий</th>
                <th rowspan="2" style="width:8%;" class="centered">Всего за период</th>
                <th rowspan="2" style="width:10%;" class="centered">% устранения</th>
                <th rowspan="2" style="width:10%;" class="centered">% от общего количества выявленых</th>
            </tr>
            <tr>
                <th class="centered">I уровень</th>
                <th class="centered">II уровень</th>
                <th class="centered">III уровень</th>
                <th class="centered">IV уровень</th>
            </tr>
            </thead>
            <tbody>
            @for($id_OPO=0; $id_OPO<count($output_data['name_opo']); $id_OPO++)
                @for($id_obj=0; $id_obj<count($output_data['name_elem'][$id_OPO]); $id_obj++)
                    @for($id_violation=0; $id_violation<count($output_data['name_violation'][$id_OPO][$id_obj]); $id_violation++)
                        <tr>
                            <td style="text-align: center">{{$output_data['name_opo'][$id_OPO]}}</td>
                            <td style="text-align: center">{{$output_data['name_elem'][$id_OPO][$id_obj]}}</td>
                            <td style="text-align: center">{{$output_data['name_violation'][$id_OPO][$id_obj][$id_violation]}}</td>
                            <td style="text-align: center">{{$output_data['num_1_level'][$id_OPO][$id_obj][$id_violation]}}</td>
                            <td style="text-align: center">{{$output_data['num_2_level'][$id_OPO][$id_obj][$id_violation]}}</td>
                            <td style="text-align: center">{{$output_data['num_3_level'][$id_OPO][$id_obj][$id_violation]}}</td>
                            <td style="text-align: center">{{$output_data['num_4_level'][$id_OPO][$id_obj][$id_violation]}}</td>
                            <td style="text-align: center">{{$output_data['num_all'][$id_OPO][$id_obj][$id_violation]}}</td>
                            <td style="text-align: center">{{$output_data['ok'][$id_OPO][$id_obj][$id_violation]}}%</td>
                            <td style="text-align: center">{{$output_data['ok_of_all'][$id_OPO][$id_obj][$id_violation]}}%</td>
                        </tr>
                    @endfor
                @endfor
            @endfor
            </tbody>
        </table>
