<section class="tab_content">
    <div class="inside_tab_padding">
        <div class="row_block gloss_new">
            <table>
                <thead>
                <tr>
                    <th>Термин</th><th>Определение</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($termins as $termin)
                <tr>
                    <td>{{$termin->termin}}</td>
                    <td>{{$termin->descr}}</td>
                </tr>
                @endforeach
                </tbody>
            </table>




        </div>
    </div>
</section>