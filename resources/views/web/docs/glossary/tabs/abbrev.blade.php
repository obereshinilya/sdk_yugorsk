<section class="tab_content">
    <div class="inside_tab_padding">
        <div class="row_block gloss_new">
            <table>
                <thead>
                <tr>
                    <th>Сокращение</th><th>Расшифровка</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($abbrevs as $abbrev)
                <tr>
                    <td>{{$abbrev->abbrev}}</td>
                    <td>{{$abbrev->desc_abb}}</td>
                </tr>
                @endforeach
                </tbody>
            </table>




        </div>
    </div>
</section>