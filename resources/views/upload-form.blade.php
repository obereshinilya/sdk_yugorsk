<div class="tabs razd_col_tab no_border">
    <div class="no_tab_table opend">
        <table class="plan_table norm_tabl">
            <thead>
            <tr class="nohover">
                <th></th>
                <th>Наименование файла</th>
                <th>Дата изменения</th>
                <th>Тип файла</th>
                <th>Сортировка</th>
            </tr>
            </thead>
            <tbody>
            @foreach($rows as $image)
                <tr>
                    <td></td>
                    <td>{{ $image->title  }}</td>
                    <td>{{ $image->created_at }}</td>
                    <td> <a href="open/{{ $image->id }}" >
                            <img src="{{ asset('assets/images/icons/pdf.svg') }}" class="pdf_i"> </a> </td>
                    <td><a href="{{ route('upload_delete',['id' => $image->id]) }}"><img alt="" src="{{asset('assets/images/icons/trash.svg')}}" class="trash_i"></a></td>
                </tr>
            @endforeach
                   </tbody>
        </table>
        <div class="table_use">
            <table>
                <tbody>
                <tr>
                    <td><p>Всего записей: {{$rows->count()}}</p></td>
                    <td>
                        <form method="post" action="{{ route('upload_file') }}" enctype="multipart/form-data">
                            <input name="_token" type="hidden" value="{{ csrf_token() }}">
                            <input  type="file"  multiple name="file[]">
                            <button type="submit" id="" class="create">Добавить <img alt="" src="{{asset('assets/images/icons/dot.svg')}}"></button>
                        </form>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>

</div>


