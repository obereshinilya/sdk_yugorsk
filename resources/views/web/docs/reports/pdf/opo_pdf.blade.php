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
<h2 class="text-muted" style="text-align: center" >{{$title}}</h2>
<table style="border-collapse: collapse;" class="table table-hover">
    <thead>
    <tr>
        <th rowspan="2" class="centered">ОПО</th>
        <th rowspan="2" class="centered">ИП ПБ ОПО</th>
        <th colspan="2" class="centered">Минимальный интегральный показатель состояния ПБ элемента ОПО</th>
    </tr>
    <tr>
        <th >ИП ПБ элемента ОПО</th>
        <th class="centered">Наименование элемента</th>
    </tr>
    </thead>
    <tbody>
    @foreach($data as $dat)
        <tr>
            <td>{{$dat['name_opos']}}</td>
            <td class="centered">{{$dat['ip_opos']}}</td>
            <td class="centered">{{$dat['ip']}}</td>
            <td>{{$dat['name']}}</td>
        </tr>
    @endforeach

    </tbody>

</table>
