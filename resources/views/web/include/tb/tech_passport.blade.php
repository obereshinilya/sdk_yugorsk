<div class="tab">
    <input type="radio" id="tech_passport" name="tab_group" checked>
    <label for="tech_passport" class="tab_title three_col_tab">Технологический паспорт ТБ</label>
    <section class="tab_content">
        <div class="inside_tab_padding">
            <div class="tech_passport_tab">
                <h4>Перечень технических устройств входящих в состав блока</h4>
                <table>
                    <thead>
                    <tr>
                        <th>Наименование технического устройства</th>
                        <th>Рег. номер</th>
                        <th>Заводской номер</th>
                        <th>Дата выпуска</th>
                        <th>Разрешенный период использования</th>
                        <th>Заводской период использования</th>
                        <th>Дата ЭПБ</th>
                        <th>Дата следующей ЭПБ</th>
                        <th>Расчетный показатель надежности</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($this_elem as $this_tb)
                    <tr>
                        <td>{{$this_tb->name}}</td>
                        <td>{{$this_tb->factory_numb}}</td>
                        <td>{{$this_tb->reg_numb}}</td>
                        <td>{{$this_tb->old}}</td>
                        <td>15</td>
                        <td>0</td>
                        <td>{{$this_tb->data_epb}}</td>
                        <td>{{$this_tb->data_next_epb}}</td>
                        <td>{{$this_tb->ntp}}</td>
                    </tr>
                    @endforeach



                    </tbody>
                </table>

                <div class="ppr_date">
                    <div class="ppr_date_single">Дата проведения ППР <span>01.08.2020</span></div>
                    <div class="ppr_date_single">Дата проведения следующего ППР <span>01.08.2022</span></div>
                </div>

            </div>

        </div>
    </section>
</div>
