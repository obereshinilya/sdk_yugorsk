@extends('web.layouts.app')
@section('title')
    Справочник ОПО
@endsection

@section('content')


@include('web.include.sidebar_doc')


    <div class="top_table">
  @include('web.include.toptable')
    </div>
<div class="inside_content">

    <div class="card-header", style="margin-top: 30px"><h2 class="text-muted" style="text-align: center" >Справочник элементов ОПО</h2>
        @can('product-create')
            <div class="bat_add"><a href="{{ route('create_Obj') }}">Добавить элемент ОПО</a></div>
        @endcan
    </div>

    <div class="inside_tab_padding" >
        <div style="background: #FFFFFF; border-radius: 6px; width: 1220px" class="row_block form51">
            <table>
                <thead>
                <tr>
                    <th style="width: 2rem">Номер</th>
                    <th style="width: 25vh">Наименование элемента ОПО</th>
                    <th style="width: 25vh">Наименование ОПО</th>
                    <th style="width: 25vh">Статус элемента</th>
                    <th style="width: 25vh"></th>
                </tr>

                </thead>
                <tbody >
                @foreach ($data as $row)
                    <tr>
                        <td style="text-align: center">{{ $row->idObj }}</td>
                        <td style="text-align: center">{{ $row->nameObj }}</td>
                        <td style="text-align: center">{{ $row->ref_opo->descOPO }}</td>
                        <td style="text-align: center">{{ $row->obj_to_status->desc_work }}</td>
                        <td  class="centered">

                            <a href="{{ route('edit_Obj',$row->idObj) }}"><img  alt="" src="{{asset('assets/images/icons/edit.svg')}}" class="check_i" style="margin-left: 20px"></a>
                            <a href="{{ route('show_Obj',$row->idObj) }}"><img  alt="" src="{{asset('assets/images/icons/search.svg')}}" class="open_i" style="margin-left: 25px"></a>

                            {!! Form::open(['method' => 'GET','route' => ['delete_Obj', $row->idObj],'style'=>'display:inline']) !!}
                            <input type="image" name="picture" src="{{asset('assets/images/icons/trash.svg')}}" class="trash_i" style="width: 15px; height: 15px; margin-top:3px; margin-right: 130px" />
                            {!! Form::close() !!}
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>

</div>
@endsection
