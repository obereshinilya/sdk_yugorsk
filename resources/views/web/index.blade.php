@extends('web.layouts.app')
@section('title')
    Главная страница ОПО
@endsection

@section('content')


@include('web.include.sidebar_opo')

    <div class="top_table">
        @include('web.include.toptable')
    </div>
    <div class="inside_content">
       <div class="row_block centered">
            <div class="third_size col_block main_info_col">
                <div class="padding_ins">
                    <div class="inside_main_info left">
                        <p>Текущий показатель</p>
                        <p id="delta_ip"></p>
                    </div>
                    <div class="inside_main_info right">
                        <p class="bold dark_grey_text clear" id="ip_opo"></p>
                        <input alt="Показатель" src="{{asset('assets/images/icons/rate/good.svg')}}" class="rate_icon clear v" id="good" type="hidden">
                        <input alt="Показатель" src="{{asset('assets/images/icons/rate/bad.svg')}}" class="rate_icon clear v" id="bad" type="hidden">
                    </div>
                    <div class="clearfix"></div>
                    @include('charts.chart_ip_opo_mini')
                </div><div class="clearfix"></div>
            </div>

            <div class="third_size col_block main_info_col">
                <div class="padding_ins">
                    <div class="inside_main_info left">
                        <p>Прогнозный показатель</p>
                        <p id="delta_pro"></p>
                    </div>
                    <div class="inside_main_info right">
                        <p class="bold dark_grey_text clear">{{isset($ver_opo->opo_to_calc_opo_pro->first()->pro_ip_opo) ? $ver_opo->opo_to_calc_opo_pro->first()->pro_ip_opo : '1.00'}}</p>
                        <input alt="Показатель" src="{{asset('assets/images/icons/rate/good.svg')}}" class="rate_icon clear v" id="good-pro" type="hidden">
                        <input alt="Показатель" src="{{asset('assets/images/icons/rate/bad.svg')}}" class="rate_icon clear v" id="bad-pro" type="hidden">
                    </div>
                    <div class="clearfix"></div>
                    @include('charts.chart_ip_opo_mini_prognoz')
                </div><div class="clearfix"></div>
            </div>

            <div class="third_size col_block main_info_col">
                <div class="padding_ins special" style="margin-top: -15px">

                    <div class="tripple_cols">
                        <p class="title">Сутки:</p>
                        <script>
                            let mins_opos_status=document.createElement("p");
                            mins_opos_status.id='mins_opos_status';
                        </script>
                          <div id="div_mins_opos_status"></div>
                           <div class="lined"></div>
{{--                           <div class="value_numb">--}}
                               <style>
                                   #chartdiv,
                                   #chartdiv1,
                                   #chartdiv2 {
                                       /*width: 100%;*/
                                       /*height: 100%;*/
                                       margin-top: -50px;
                                       margin-left: -15px;
                                       /*display: inline-block;*/
                                   }

                               </style>
                               <div id="chartdiv" >
                                   @include('charts.opo.chart_opo_day_min')
                               </div>
{{--                               <img alt="Показатель" src="{{asset('assets/images/icons/rate/good.svg')}}" class="rate_icon clear">--}}
{{--                               <p class="bold dark_grey_text clear" id="mins_opos_ip_opo"></p>--}}
{{--                     </div>--}}
                    </div>

                    <div class="tripple_cols bordered">
                        <p class="title">Месяц:</p>
                        <script>
                            let mins_opo_mounths_status=document.createElement("p");
                            mins_opo_mounths_status.id='mins_opo_months_status';
                        </script>
                        <div id="div_mins_opo_months_status"></div>
                        <div class="lined"></div>
                        <div class="value_numb">
{{--                            <img alt="Показатель" src="{{asset('assets/images/icons/rate/good.svg')}}" class="rate_icon clear">--}}
{{--                            <p class="bold dark_grey_text clear" id="mins_opo_months_ip_opo"></p>--}}
                            <div id="chartdiv1" >
                                @include('charts.opo.chart_opo_day_min1')
                            </div>
                        </div>
                    </div>

                    <div class="tripple_cols">
                        <p class="title">Год:</p>
                        <script>
                            let mins_opo_year_status=document.createElement("p");
                            mins_opo_year_status.id='mins_opo_year_status';
                        </script>
                        <div id="div_mins_opo_year_status"></div>
                        <div class="lined"></div>
                        <div class="value_numb">
{{--                            <img alt="Показатель" src="{{asset('assets/images/icons/rate/good.svg')}}" class="rate_icon clear">--}}
{{--                            <p class="bold dark_grey_text clear" id="mins_opo_year_ip_opo"></p>--}}
                            <div id="chartdiv2" >
                                @include('charts.opo.chart_opo_day_min2')
                            </div>
                        </div>
                    </div>

                    <div class="clearfix"></div>
                </div>
            </div>

        </div>
      @include('charts.opo.charts_opo')
      @include('web.include.futer_table')
  </div>

<script>
    function updateOpoParams(){
        var sidebar_rounded=$('#sidebar_bottom_rounded');

        $.ajax({
            url:"/mini_graphics_opo/{{$id}}",
            type:"GET",
            success:function(data)
            {
                $('#delta_ip').text(data['raznost'])
                if (data['check'] == 1){
                    document.getElementById('delta_ip').style.color='#49ce56'
                    document.getElementById('good').type="image"
                    document.getElementById('good').style.maxHeight="15px"
                    document.getElementById('bad').type="hidden"
                } if (data['check'] == 0) {
                document.getElementById('delta_ip').style.color='#f26161'
                document.getElementById('good').type="hidden"
                document.getElementById('bad').type="image"
                document.getElementById('bad').style.maxHeight="15px"
            } else {
                $('#delta_ip').text('0.00')
                document.getElementById('delta_ip').style.color="#49ce56"
                document.getElementById('good').type="hidden"
                document.getElementById('bad').type="hidden"
            }
                $('#delta_pro').text(data['raznost_pro'])
                if (data['pro_check'] == 1){
                    document.getElementById('delta_pro').style.color='#49ce56'
                    document.getElementById('good-pro').type="image"
                    document.getElementById('good-pro').style.maxHeight="15px"
                    document.getElementById('bad-pro').type="hidden"
                } if (data['pro_check'] == 0) {
                document.getElementById('delta_pro').style.color='#f26161'
                document.getElementById('good-pro').type="hidden"
                document.getElementById('bad-pro').type="image"
                document.getElementById('bad-pro').style.maxHeight="15px"
            } else {
                $('#delta_pro').text('0.00')
                document.getElementById('delta_pro').style.color="#49ce56"
                document.getElementById('good-pro').type="hidden"
                document.getElementById('bad-pro').type="hidden"
            }
            }
        })

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




<script>
    function sleep(sec) {
        return new Promise(resolve => setTimeout(resolve, sec*1000));
    }


    function clearTable(table){
        while(table.rows.length > 0) {
            table.deleteRow(table.rows.length-1);
        }
    }

    async function getDbInfo(){
        while(true){
            var GetDataReq=new XMLHttpRequest();
            let count=0
             GetDataReq.onreadystatechange =function() {
                 if (GetDataReq.readyState == 4 && GetDataReq.status == 200) {
                     let p_value='value ';
                     let arr=[]
                     arr=JSON.parse(GetDataReq.responseText);//Принимаем данные в json
                     if (arr['new_data']) {
                         count = arr['db_count'];
                         document.getElementById('ip_opo').innerHTML = arr['ip_opo'];


                         if (arr['mins_opos_int_status'] == 1) {
                             p_value += 'good'
                         } else if (arr['mins_opos_int_status'] == 2) {
                             p_value += 'normal'
                         } else if (arr['mins_opos_int_status'] == 3) {
                             p_value += 'bad'
                         } else p_value += 'critical'


                         mins_opos_status.className = p_value;
                         mins_opos_status.textContent = arr['mins_opos_status'];
                         document.getElementById('div_mins_opos_status').appendChild(mins_opos_status);
                         // document.getElementById('mins_opos_ip_opo').innerHTML = arr['mins_opos_ip_opo'];

                         p_value = 'value '
                         if (arr['mins_opo_months_int_status'] == 1) {
                             p_value += 'good'
                         } else if (arr['mins_opo_months_int_status'] == 2) {
                             p_value += 'normal'
                         } else if (arr['mins_opo_months_int_status'] == 3) {
                             p_value += 'bad'
                         } else p_value += 'critical'

                         mins_opo_mounths_status.className = p_value
                         mins_opo_mounths_status.textContent = arr['mins_opo_months_status']
                         document.getElementById('div_mins_opo_months_status').appendChild(mins_opo_mounths_status);
                         // document.getElementById('mins_opo_months_ip_opo').innerHTML = arr['mins_opo_months_ip_opo']

                         p_value = 'value '
                         if (arr['mins_opo_year_int_status'] == 1) {
                             p_value += 'good'
                         } else if (arr['mins_opo_year_int_status'] == 2) {
                             p_value += 'normal'
                         } else if (arr['mins_opo_year_int_status'] == 3) {
                             p_value += 'bad'
                         } else p_value += 'critical'

                         mins_opo_year_status.className = p_value
                         mins_opo_year_status.textContent = arr['mins_opo_year_status']
                         document.getElementById('div_mins_opo_year_status').appendChild(mins_opo_year_status);
                         // document.getElementById('mins_opo_year_ip_opo').innerHTML = arr['mins_opo_year_ip_opo']

                         let progress_bars = document.getElementsByClassName('progress-bar');
                         let sidebars = document.getElementById('sidebar_bottom_rounded').getElementsByClassName('bold dark_grey_text clear');
                         //sidebar_bottom_rounded.getElementsByClassName('bold dark_grey_text clear').item(i).innerHTML=arr['all_opo_ip'][i];

                         arr['all_opo_ip'].forEach(function (item, i) {
                             sidebars.item(i).innerHTML = item;
                             let progressbar_className = 'progress-bar '
                             if (item <= 0.2) {
                                 progressbar_className += 'bg-danger'
                             } else if (item > 0.2 && item <= 0.5) {
                                 progressbar_className += 'bg-warning'
                             } else if (item > 0.5 && item <= 0.8) {
                                 progressbar_className += 'bg-risk'
                             } else if (item > 0.8 && item <= 1) {
                                 progressbar_className += 'bg-success'
                             }
                             progress_bars.item(i).className = progressbar_className;
                             progress_bars.item(i).style = "width: " + item * 100 + '%';
                         });
                         //arr['opo'].forEach(function(item, i){
                         {{--let div_sidebar_bottom_single=document.createElement('div');--}}
                         {{--if (item['idOPO']==arr['id']){--}}
                         {{--    div_sidebar_bottom_single.className='sidebar_bottom_single active'--}}
                         {{--}--}}
                         {{--else{--}}
                         {{--    div_sidebar_bottom_single.className='sidebar_bottom_single'--}}
                         {{--}--}}

                         {{--let div_clear=document.createElement('div');--}}
                         {{--div_clear.className="clear";--}}

                         {{--let div_single_fond_name=document.createElement('div');--}}
                         {{--div_single_fond_name.className='single_fond_name rounded';--}}

                         {{--let light_blue_text=document.createElement('a');--}}
                         {{--light_blue_text.className='light_blue_text';--}}
                         {{--light_blue_text.href='/opo/'+item['idOPO'];--}}
                         {{--light_blue_text.text=item['descOPO'];--}}

                         {{--let local_clear_a=document.createElement('a');--}}
                         {{--local_clear_a.href='/opo/'+item['idOPO']+'/plan';--}}

                         {{--let img_settings=document.createElement('img');--}}
                         {{--img_settings.src={{asset('assets/images/icons/settings.svg')}};--}}
                         {{--local_clear_a.appendChild(img_settings);--}}

                         {{--let p_grey_text=document.--}}


                         //});

                         let footer_table = document.getElementById('footer_table');
                         let footer_table_date = footer_table.getElementsByClassName('td_date');
                         let footer_table_status = footer_table.getElementsByClassName('td_status');
                         let footer_table_opo = footer_table.getElementsByClassName('td_opo');
                         let footer_table_element = footer_table.getElementsByClassName('td_element');
                         let footer_table_number = footer_table.getElementsByClassName('td_number');
                         let footer_table_event = footer_table.getElementsByClassName('td_event');
                         arr['jas_opo'].forEach(function (item, i) {
                             if (item.length!=0) {
                                 footer_table_date.item(i).innerHTML = item['date'];
                                 footer_table_status.item(i).innerHTML = item['level'];
                                 footer_table_opo.item(i).innerHTML = item['descOPO'];
                                 footer_table_element.item(i).innerHTML = item['nameObj'] + '. (Элемент объекта ОПО ' + item['descOPO']+')';
                                 footer_table_number.item(i).innerHTML = item['status'];
                                 footer_table_event.item(i).innerHTML = item['name'];
                             }


                         });
                     }
                 }
             };
            //
            GetDataReq.open("GET", location.pathname+'/data/'+count.toString(), true);
            GetDataReq.send();

            await sleep(60);

        }
    }

    getDbInfo();
</script>


{{--<script src="{{asset('/js/jquery.min.js')}}"></script>--}}

@include('web.include.script-lib.am4')
@include('web.include.script-lib.highcharts')


@endsection
