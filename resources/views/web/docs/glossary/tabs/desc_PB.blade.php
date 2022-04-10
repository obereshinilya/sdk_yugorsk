<section class="tab_content">
    <div class="inside_tab_padding">
        <div class="row_block gloss_new">
            <table>
                <thead>
                <tr>
                    <th>Показатель</th><th>Значение</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($desc_pbs as $desc_pb)
                <tr>
                    <td>{{$desc_pb->abbrev}}</td>
                    <td>{{$desc_pb->desc_abbver}}</td>
                </tr>
                @endforeach
                </tbody>
            </table>




        </div>
    </div>
</section>