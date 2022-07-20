

@extends('web.layouts.app')
@section('title')
    Журнал аварийных событий
@endsection

@section('content')


    @include('web.include.sidebar_doc')


    <div style="height: 75.3vh">

        <div class="row justify-content-center" style="height: 100%">
            <div class="col-md-12" style="height: 100%">
                <div class="card" style="height: 100%">
                    <div class="card-header">
                        <h2 class="text-muted" style="text-align: center" >Журнал аварийных событий
                        </h2>
                    </div>

                    <div class="inside_tab_padding form51" style="height:100%; padding-left: 0px">
                        <div style="background: #FFFFFF; border-radius: 6px" class="form51">
                            <table class="myTable" id="myTable">
                                <thead>
                                <tr>
                                    <th>Дата</th>
                                    <th>Статус</th>
                                    <th>ОПО</th>
                                    <th>Элемент ОПО</th>
                                    <th>Состояние</th>
                                    <th>Описание события</th>
                                    <th>Комментарий</th>
                                </tr>
                                </thead>
                                <tbody>
                                    @foreach($data_to_jas as $row)
                                        <tr>
                                            <td>
                                                <?php
                                                echo date("Y-m-d H:i:s", strtotime($row->date))
                                                ?>
                                            </td>
                                            <td>{{$row->status}}</td>
                                            <td>{{$row->opo}}</td>
                                            <td>{{$row->elem_opo}}</td>
                                            <td>
                                                <?php
                                                if ($row->check == false){
                                                    echo 'Новое';
                                                } else{
                                                    echo 'Просмотрено';
                                                };
                                                ?>
                                            </td>
                                            <td>{{$row->sobitie}}</td>
                                            <td>{{$row->comment}}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<script>
    $(document).ready( function () {
        $('#myTable').DataTable({
            "pagingType": "full_numbers",
            destroy: true,
            order: [[0, 'desc']],

        });
    } );

</script>
@endsection
