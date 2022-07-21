

@extends('web.layouts.app')
@section('title')
    Журнал аварийных событий
@endsection

@section('content')
    <link rel="stylesheet" href="{{asset('assets/css/table.css')}}">
    <script src="{{asset('assets/js/jquery.dataTables.min.js')}}"></script>

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
                                    <th style="text-align: center">Дата</th>
                                    <th style="text-align: center">Статус</th>
                                    <th style="text-align: center">ОПО</th>
                                    <th style="text-align: center">Элемент ОПО</th>
                                    <th style="text-align: center">Описание события</th>
                                    <th style="text-align: center">Комментарий</th>
                                    <th style="text-align: center">Состояние</th>
                                </tr>
                                </thead>
                                <tbody>
                                    @foreach($data_to_jas as $row)
                                        <tr>
                                            <td style="text-align: center">
                                                <?php
                                                echo date("Y-m-d H:i:s", strtotime($row->date))
                                                ?>
                                            </td>
                                            <td style="text-align: center">{{$row->status}}</td>
                                            <td style="text-align: center">{{$row->opo}}</td>
                                            <td style="text-align: center">{{$row->elem_opo}}</td>
                                            <td style="text-align: center">{{$row->sobitie}}</td>
                                            <td style="text-align: center">{{$row->comment}}</td>
                                            <td style="text-align: center">
                                                <?php
                                                if ($row->check == false){
                                                    echo "<button row-id=\"$row->id\" class=\"btn btn-default\">Квитировать</button>";
                                                } else{
                                                    echo 'Просмотрено';
                                                };
                                                ?>
                                            </td>
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
        $('.btn').click(function(){
            var id = this.getAttribute('row-id')
            console.log(id)
            $.ajax({
                url:'/jas_commit/'+id,
                type:'GET',
                success:(res)=>{
                    var td = this.parentNode
                    td.removeChild(this)
                    td.innerText = 'Просмотрено'
                }
            })
        });
    } );

</script>
@endsection
