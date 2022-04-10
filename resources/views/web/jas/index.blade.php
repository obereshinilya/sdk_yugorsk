@extends('web.layouts.app')
@section('title')
    Журнал аварийных сообщений
@endsection

@section('content')

            @include('web.include.sidebar_opo')


    <div class="top_table full_table">
        <div class="table_head_block">
            <img alt="" src="{{asset('assets/images/t_left.svg')}}" class="table_left_corner">
            <table>
                <tbody>
                <tr>
{{--                    <td class="td_ch">           </td>--}}
                    <td class="td_date ps_el">@sortablelink('data', 'Дата')</td>
                    <td class="td_status ps_el">@sortablelink('level', 'Тяжесть')</td>
                    <td class="td_opo ps_el">ОПО</td>
                    <td class="td_element ps_el">Элемент ОПО</td>
                    <td class="td_number ps_el">Статус</td>
                    <td class="td_event ps_el">Наименование события</td>
                    <td class=""></td>
                    <td class="td_btn activated"><a href="{{asset('/opo')}}">Закрыть журнал</a></td>

                </tr>
                </tbody>
            </table>
{{--            <div class="table_filter">--}}
{{--                <div>Выбрать период</div>--}}
{{--                <div>@sortablelink('name', 'Событие', ['filter' => 'active, visible'], ['class' => 'td_number ps_el', 'rel' => 'nofollow'])</div>--}}
{{--                <div>Сортировать по</div>--}}
{{--            </div>--}}
        </div>
        <div class="top_table_inside full_table" style="height: 82.5vh">
            <div class="tabs razd_col_tab no_border">
                <div class="no_tab_table opend" style="height: 70vh">
                    <table class="plan_table norm_tabl">
                        <tbody>
                        @foreach ($jas as $value)
                            <tr>
{{--                                <td class="td_ch">{{$value->id}}</td>--}}
                                <td class="td_date">{{date('d-m-Y H:i', strtotime($value->data))}}</td>
                                <td class="td_status" >{{$value->level}}</td>
                                <td class="td_opo">{{$value->jas_to_opo->descOPO}}</td>
                                <td class="td_element">{{$value->jas_to_elem->nameObj}}. (Элемент объекта ОПО {{$value->jas_to_opo->descOPO}})</td>
                                <td class="td_number" >{{$value->status}}</td>
                                <td class="td_event">{{$value->name}}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="table_use" style="height: 12vh; position: static; width: auto">
                        <table>
                            <tbody>
                            <tr>
                                <td><p>Всего записей:{{$all_jas}}</p></td>
                            </tr>
                            <tr>
                                {!! $jas->links() !!}
                            </tr>
                            </tbody>
                        </table>
                    </div>
            </div>
        </div>
    </div>


            <script>
                function updateOpoParams(){
                    var sidebar_rounded=$('#sidebar_bottom_rounded');

                    $.ajax({
                        url:'/opo_params/{{$id}}',
                        type:"GET",
                        success:function(data){
                            // console.log(data);
                            // sidebar_rounded.html('')

                            var sidebar_html='';
                            for (var opo_val of data['opo']){
                                if ({{$id}}==opo_val['idOPO']){
                                    sidebar_html+='<div class="sidebar_bottom_single active">'
                                }
                                else{
                                    sidebar_html+='<div class="sidebar_bottom_single">'
                                }
                                function outer (ip_opo){
                                    var outer='<div class="progress">'+
                                        '<div class="progress-bar ';

                                    if (ip_opo<=0.2){
                                        outer+='bg-danger"'
                                    }
                                    else if( ip_opo<=0.5 && ip_opo>0.2){
                                        outer+='bg-warning"'
                                    }
                                    else if (ip_opo<=0.8 && ip_opo>0.5){
                                        outer+='bg-risk"'
                                    }
                                    else if (ip_opo<=1 && ip_opo>0.8){
                                        outer+='bg-success"'
                                    }

                                    outer+=`role="progressbar" style="width: ${ip_opo*100}%" aria-valuenow="0.3" aria-valuemin="0"`+
                                        'aria-valuemax="1"></div></div></div>'
                                    return outer;
                                }


                                sidebar_html+='<div class="clear">'+
                                    '<div class="single_fond_name rounded">'+
                                    `<a class="light_blue_text" href="/opo/${opo_val['idOPO']}">`+
                                    `${opo_val['descOPO']}`+
                                    '</a>'+
                                    `<a href="/opo/${opo_val['idOPO']}/plan"><img alt="" src="{{asset('assets/images/icons/settings.svg')}}"></a>`+
                                    '<p class="grey_text">ООО "Газпром добыча Астрахань"</p>'+


                                    '</div>'+
                                    ' <div class="single_fond_rate clear">'+
                                    `<p class="bold dark_grey_text clear">${opo_val['ip_opo']}</p>`+
                                    `<img alt="Показатель" src="{{asset('assets/images/icons/rate/good.svg')}}"`+
                                    'class="rate_icon clear">'+
                                    '</div>'+
                                    '</div>'+'<div class="clearfix"></div>'+outer(opo_val['ip_opo'])


                                // console.log(opo_val)
                            }
                            sidebar_rounded.html(sidebar_html);


                            $('#min_ip_of_opo').text(data['min_last'])
                            var window = document.getElementById('min_ip_of_opo')
                            if (data['min_last'] <= 1.00) {
                                $('#min_ip_of_opo').backgroundColor="#49ce56";
                                window.style.backgroundColor = "#49ce56";
                            }
                            if (data['min_last'] <= 0.80) {
                                window.style.backgroundColor = "#ffca45";
                            }
                            if (data['min_last'] <= 0.50) {
                                window.style.backgroundColor = "#f58b2c";
                            }
                            if (data['min_last'] <= 0.20) {
                                window.style.backgroundColor = "#f26161";
                            }
                        }
                    })
                }

                $(document).ready(function (){
                    updateOpoParams();
                    setInterval(updateOpoParams, 6000);
                })
            </script>
@endsection
