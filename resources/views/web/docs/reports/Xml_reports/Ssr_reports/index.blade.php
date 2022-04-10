@extends('web.layouts.app')
@section('title')
    Реестр отчетов о средних рисках
@endsection

@push('XMLSign')
    <script language="javascript" src="{{asset('XMLSign/es6-promise.min.js')}}"></script>
    <script language="javascript" src="{{asset('XMLSign/ie_eventlistner_polyfill.js')}}"></script>
    <script language="javascript" src="{{asset('XMLSign/cadesplugin_api.js')}}"></script>

    <script src="{{asset('XMLSign/XMLSign2.js')}}"></script>
    <link href="{{ asset('XMLSign/XMLSign.css') }}" rel="stylesheet">
@endpush

@section('content')




@include('web.include.sidebar_doc')


    <div class="top_table">
  @include('web.include.toptable')
    </div>
<div class="inside_content">

    <div class="card-header", style="margin-top: 30px"><h2 class="text-muted" style="text-align: center" >Реестр передачи сообщений о ССР</h2>
        @can('product-create')
{{--            <div class="bat_add"><a href="{{ route('create_Obj') }}">Добавить элемент ОПО</a></div>--}}
        @endcan
    </div>

    <div class="inside_tab_padding" >
        <div style="background: #FFFFFF; border-radius: 6px; width: 1220px" class="row_block form51">
            <table>
                <thead>
                <tr>
                    <th class="td_date" style="width: 2rem">Номер</th>
                    <th class="td_date" style="width: 25vh">Наименование события</th>
                    <th class="td_date" style="width: 25vh">Наименование элемента ОПО</th>
                    <th class="td_date" style="width: 25vh">Дата</th>
                    <th class="td_date" style="width: 25vh">Статус отчета</th>
                </tr>

                </thead>
                <tbody >
                @foreach ($ssr as $row)
                    <tr>
                        <td style="text-align: center">{{ $row->id }}</td>
                        <td class="td_element ps_el" style="text-align: center">{{ $row->desc_event }}</td>
                        <td style="text-align: center">{{ $row->ssr_to_obj->nameObj }}</td>
                        <td class="td_date" style="text-align: center">{{ $row->created_at }}</td>
                        <td  class="centered">
                            @if (! $row->send)
                            <div class="bat_add"><a class="bat_add">Подписать</a></div>
                            @else
                            <div class="bat_info"><a href="#">Отправлен</a></div>
                            @endif
                                <a href="{{route('show_OPO', $row->id)}}"><img  alt="" src="{{asset('assets/images/icons/search.svg')}}" class="open_i" style="margin-left: 25px"></a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>

</div>
    <div id='SIGN'></div>
    <script>
        document.addEventListener('DOMContentLoaded', function (){
            var xml_test=new XMLSign('<data>blablabla</data>', 'foo', 'SIGN');
            var dlg_content=document.getElementById('SIGN');
            var modal=new ModalWindow('Электронно-цифровая подпись документа', dlg_content, AnimationsTypes['stickyUp']);
            var send_btns=document.querySelectorAll('.bat_add');
            for(btn of send_btns){
                btn.addEventListener('click', ()=>{
                    //Добавить запрос на xml
                    //Ну например можно ajax запросом вытянуть данные с сервера и поместить в переменную data_to_sign
                    var data_to_sign="";
                    xml_test.set_XMLStrToSign(data_to_sign)

                    xml_test.set_url_to_send('URL адресата')

                    modal.show()
                })
            }
        });
    </script>

@endsection
