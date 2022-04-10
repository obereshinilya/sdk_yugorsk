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
                <tr>
                    <td colspan="2" rowspan="2">Критерий оценки<br></td>
                    <td colspan="10">Количество нарушений по критериям</td>
                </tr>
                <tr>
                    @for($i=0; $i<count($data); $i++)
                        <td>{{$data[$i]['name_opo']}}</td>
                    @endfor
                    <td>Итого</td>
                </tr>
                <tr>
                    <?php
                    $sum_red = 0;
                    ?>
                    <td rowspan="3" >Критерий №1<br>Тяжесть возможных последствий </td>
                    <td class="centered">Красная зона</td>
                    @for($i=0; $i<count($data); $i++)
                        <td style="text-align: center">{{$data[$i]['k1_red']}}</td>
                        <?php
                        $sum_red = $data[$i]['k1_red'] + $sum_red;
                        ?>
                    @endfor
                    <td style="text-align: center">{{$sum_red}}</td>
                </tr>
                <tr>
                    <td>Желтая зона</td>
                    <?php
                    $sum_yellow = 0;
                    ?>
                    @for($i=0; $i<count($data); $i++)
                        <td style="text-align: center">{{$data[$i]['k1_yellow']}}</td>
                        <?php
                        $sum_yellow = $data[$i]['k1_yellow'] + $sum_yellow;
                        ?>
                    @endfor
                    <td style="text-align: center">{{$sum_yellow}}</td>
                </tr>
                <tr>
                    <td>Зеленая зона</td>
                    <?php
                    $sum_green = 0;
                    ?>
                    @for($i=0; $i<count($data); $i++)
                        <td style="text-align: center">{{$data[$i]['k1_green']}}</td>
                        <?php
                        $sum_green = $data[$i]['k1_green'] + $sum_green;
                        ?>
                    @endfor
                    <td style="text-align: center">{{$sum_green}}</td>
                </tr>
                <tr>
                    <td rowspan="3">Критерий №2 <br> Способ устранения несоответствий</td>
                    <td class="centered">Собственными силами</td>
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
                    <td>Текущий ремонт</td>
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
                    <td>Капитальный ремонт</td>
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
                    <td rowspan="6">Критерий №3 <br> Причины возникновения несоответствий</td>
                    <td class="centered">Подготовка персонала</td>
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
                    <td>Производственная дисциплина</td>
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
                    <td>Деградационный фактор</td>
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
                    <td>Эксплуатационный фактор</td>
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
                    <td>Производственный фактор</td>
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
                    <td>Низкое качество ремонтных работ</td>
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
