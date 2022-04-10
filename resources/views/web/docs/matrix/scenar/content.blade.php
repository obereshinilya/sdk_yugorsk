<div class="doc_header">
    <table>
        <tbody>
        <tr>
            <td><img alt="" src="assets/images/icons/search.svg"></td>
            <td><input type="text" id="" placeholder=""></td>
            <td><select id=""><option select>Объект ОПО</option><option>2</option><option>3</option></select></td>
            <td><select id=""><option select>Элемент ОПО</option><option>2</option><option>3</option></select></td>
            <td><select id=""><option select>Манессман</option><option>2</option><option>3</option></select></td>
        </tr>
        </tbody>
    </table>
</div>
<div class="tabs razd_col_tab no_border">
    <div class="no_tab_table scene_table">



        <table class="plan_table order-count">
            <thead>
            <tr class="nohover">
                <th>Наименование опасного события</th>
                <th>Тип объекта</th>
                <th>Тип элемента</th>
            </tr>
            </thead>
            <tbody>
            <tr class="order">
                <td class="plus">Разгерметизация трубопровода очищенного газа</td>
                <td>Основная + Сателлит</td>
                <td>Скважина</td>
            </tr>
            <!-- Начало вложенной таблицы -->
            <tr class="order_item">
                <td colspan="3">
                    <table class="plan_table">
                        <thead>
                        <tr class="nohover">
                            <th>Наименование параметра</th>
                            <th>Наименование</th>
                            <th>Коэф-т</th>
                            <th>Триггер</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr class="">
                            <td>pal010_xh01</td>
                            <td>Низкое давление осушенного газа</td>
                            <td>0.15</td>
                            <td><label class="switch switch-sm"><input type="checkbox" checked><span></span></label></td>
                            <td><a href="#"><img alt="" src="assets/images/icons/trash.svg" class="trash_i"></a></td>
                        </tr>
                        <tr class="">
                            <td>pal010_xh01</td>
                            <td>Низкое давление осушенного газа</td>
                            <td>0.15</td>
                            <td><label class="switch switch-sm"><input type="checkbox"><span></span></label></td>
                            <td><a href="#"><img alt="" src="assets/images/icons/trash.svg" class="trash_i"></a></td>
                        </tr>

                        </tbody>
                    </table>
                </td>
            </tr>
            <!-- // Конец вложенной таблицы -->
            <tr class="order">
                <td class="plus">Разгерметизация трубопровода очищенного газа</td>
                <td>Основная + Сателлит</td>
                <td>Скважина</td>
            </tr>
            <!-- Начало вложенной таблицы -->
            <tr class="order_item">
                <td colspan="3">
                    <table class="plan_table">
                        <thead>
                        <tr class="nohover">
                            <th>Наименование параметра</th>
                            <th>Наименование</th>
                            <th>Коэф-т</th>
                            <th>Триггер</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr class="">
                            <td>pal010_xh01</td>
                            <td>Низкое давление осушенного газа</td>
                            <td>0.15</td>
                            <td><label class="switch switch-sm"><input type="checkbox" checked><span></span></label></td>
                            <td><a href="#"><img alt="" src="assets/images/icons/trash.svg" class="trash_i"></a></td>
                        </tr>
                        <tr class="">
                            <td>pal010_xh01</td>
                            <td>Низкое давление осушенного газа</td>
                            <td>0.15</td>
                            <td><label class="switch switch-sm"><input type="checkbox"><span></span></label></td>
                            <td><a href="#"><img alt="" src="assets/images/icons/trash.svg" class="trash_i"></a></td>
                        </tr>

                        </tbody>
                    </table>
                </td>
            </tr>
            <!-- // Конец вложенной таблицы -->

            </tbody>
        </table>



        <div class="table_use">
            <table>
                <tbody>
                <tr>
                    <td><p>Всего записей: 70</p><p>Выбрано: 2 <a><img alt="" src="assets/images/icons/close.svg"></a></p></td>
                    <td><button id="" class="delete">Удалить выбранные <img alt="" src="assets/images/icons/close.svg"></button>
                        <button id="" class="cancel">Отмена</button></td>
                    <td><button id="" class="create">Добавить <img alt="" src="assets/images/icons/dot.svg"></button></td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>

</div>
<script>
    $('.plus').click(function() {
        $(this).parents('.order').nextUntil(".order",'.order_item').toggle();
    });
</script>