<div class="tab">
    <input type="radio" id="func_passport" name="tab_group">
    <label for="func_passport" class="tab_title three_col_tab">Функциональный паспорт ТБ</label>
    <section class="tab_content not_white">
        <div class="inside_tab_padding not_white">

            <div class="func_passport_top">
                <h4>Расчетные показатели промышленной безопасности технического блока</h4>
                        <div class="row_block">
                    <div class="third_col centered">

                        @include('charts.function_pass_tb.Collumn_tb')
                    </div>
                    <div class="third_col centered">
                        <style>
                            #chartdiv {
                                width: 100%;
                                height: 220px;
                            }

                        </style>

                        <div id="chartdiv"></div>
                        @include('charts.function_pass_tb.chart_2')

                        <p>Обобщенный показатель<br/>отклонений АПК для ТБ<p>
                    </div>

                    <div  class="third_col centered">
                        <style>
                            #chartdiv1 {
                                width: 100%;
                                height: 220px;
                            }

                        </style>

                        <div id="chartdiv1"></div>
                        @include('charts.function_pass_tb.chart_1')
                        <p>Обобщенный показатель<br/>состояния эксплуатации и обслуживания ТБ<p>
                    </div>
                </div>
            </div>

            <div class="func_passport_bottom">
                <h4>Перечень несоответствий выявленных при проведении производственного контроля</h4>
                <div class="ppr_date_single">Всего несоответствий <span>{{$this_elem_apk->count()}}</span></div>
                <table>
                    <thead>
                    <tr>
                        <th>Несоответствия</th>
                        <th>Документ</th>
                        <th>Дата</th>
                        <th>Коэф-нт</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($this_elem_apk as $this_tb_apk)
                    <tr>
                        <td>{{$this_tb_apk->Details}}</td>
                        <td>{{$this_tb_apk->Document}} </td>
                        <td>{{$this_tb_apk->CompleteDate}}</td>
                        <td>{{$this_tb_apk->Weight}}</td>
                    </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>

        </div>
    </section>
</div>
