<style>
    body { font-family: DejaVu Sans, sans-serif; font-size: 10px}
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

<h2 class="text-muted" style="text-align: center" >{{$title}}</h2>
<table style="border-collapse: collapse; width: 100%" class="table table-hover">
    <tr>
        <td colspan="2" rowspan="2" style="text-align: center">Критерий оценки<br></td>
        <td colspan="10" style="text-align: center">Количество нарушений по критериям</td>
    </tr>
    <tr>
        @for($i=1; $i<count($data['name_opo'])+1; $i++)
            <td>{{$data['name_opo'][$i]}}</td>
        @endfor
        <td style="text-align: center">Итого</td>
    </tr>
    <tr>
        <td style="text-align: center" rowspan="3" >Критерий №1<br>Тяжесть возможных последствий </td>
        <td style="text-align: center" class="centered">Красная зона</td>
        @for($i=1; $i<count($data['k1_red'])+1; $i++)
            <td style="text-align: center">{{$data['k1_red'][$i]}}</td>
        @endfor
        <td style="text-align: center">{{$sum['red']}}</td>
    </tr>
    <tr>
        <td style="text-align: center">Желтая зона</td>
        @for($i=1; $i<count($data['k1_red'])+1; $i++)
            <td style="text-align: center">{{$data['k1_yellow'][$i]}}</td>
        @endfor
        <td style="text-align: center">{{$sum['yellow']}}</td>
    </tr>
    <tr>
        <td style="text-align: center">Зеленая зона</td>
        @for($i=1; $i<count($data['k1_red'])+1; $i++)
            <td style="text-align: center">{{$data['k1_green'][$i]}}</td>
        @endfor
        <td style="text-align: center">{{$sum['green']}}</td>
    </tr>
    <tr>
        <td style="text-align: center" rowspan="3">Критерий №2 <br> Способ устранения несоответствий</td>
        <td style="text-align: center" class="centered">Собственными силами</td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
    </tr>
    <tr>
        <td style="text-align: center">Текущий ремонт</td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
    </tr>
    <tr>
        <td style="text-align: center">Капитальный ремонт</td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
    </tr>
    <tr>
        <td style="text-align: center" rowspan="6">Критерий №3 <br> Причины возникновения несоответствий</td>
        <td style="text-align: center" class="centered">Подготовка персонала</td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
    </tr>
    <tr>
        <td style="text-align: center">Производственная дисциплина</td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
    </tr>
    <tr>
        <td style="text-align: center">Деградационный фактор</td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
    </tr>
    <tr>
        <td style="text-align: center">Эксплуатационный фактор</td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
    </tr>
    <tr>
        <td style="text-align: center">Производственный фактор</td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
    </tr>
    <tr>
        <td style="text-align: center">Низкое качество ремонтных работ</td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
    </tr>
</table>
