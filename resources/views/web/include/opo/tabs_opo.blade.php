
<div class="tabs">
   <div class="tab two_col_tab">
        <input type="radio" id="opo_info" name="tab_group" checked>
        <label for="opo_info" class="tab_title">Общие сведения ОПО</label>
        <section class="tab_content not_white">
            <div class="inside_tab_padding not_white">

                <div class="func_passport_top">

                    <table class="opo_info">
                        <tbody>
                        <tr class="padding_tabl_button">
                            <td class="fond_calendar_btn">
                                <a href="{{ url('/eventsCal/'.$ver_opo->idOPO)}}">Календарь событий</a>

                            </td>
                            <td class="fond_calendar_btn">
                                <a href="{{ url('/docs/predRTN')}}">Журнал предписаний</a>
                                <a href="{{ url('/opo/'.$ver_opo->idOPO.'/maintenances')}}">Календарь ППР</a>
                            </td>

                        </tr>
                        <tr>
                            <td>Наименование ОПО:</td>
                            <td>{{$ver_opo->descOPO}}</td>
                        </tr>
                        <tr>
                            <td>Полное наименование ОПО:</td>
                            <td>{{$ver_opo->fullDescOPO}}</td>
                        </tr>
                        <tr>
                            <td>Класс опасности:</td>
                            <td>{{$ver_opo->classHazard}}</td>
                        </tr>
                        <tr>
                            <td>Регистрационный номер ОПО:</td>
                            <td>{{$ver_opo->regNumOPO}}</td>
                        </tr>
                        <tr>
                            <td>Дата регистрации:</td>
                            <td>{{$ver_opo->dateReg}}</td>
                        </tr>
                        <tr>
                            <td>Статус:</td>
                            <td>{{$ver_opo->flDel}}</td>
                        </tr>

                        </tbody>
                    </table>
                    <table class="opo_info">
                        <tbody>
                        <tr>
                            <td>Интегральные показатели</td>
                            <td>Проактивные показатели</td>
                        </tr>
                        <tr>
                            <td class="inntegral">
                                <div class="replace div2" id="chartdiv" >
                                    @include('charts.chart_1')
                                </div>
                            </td>
                            <td class="inntegral">
                                <div class="replace div2" id="chartdiv_pro" >
                                    @include('charts.chart_opo_pro')
                                </div>
                            </td>
                        </tr>


                     </tbody>
                    </table>

                </div>
                <div class="func_passport_bottom tabled_rate">
                    <table>
                        <tbody>
                        <tr>
                            <td class="rating">
                                <div class="div1">
                                    <h3 class="red">{{count($data_rtn_noncheck)+count($data_rtn_check)}}</h3> <p>Количество предписаний<br/>Ростехнадзора</p>
                                    @include('charts.opo.chart_rtn_pred_mini')
                                </div>
                            </td>

                            <td class="rating">
                                <div class="div1">
                                    <h3 class="blue">75%</h3> <p>Оценка эффективности<br/>проведения ПБ</p>
                                    @include('charts.opo.chart_epk_opo_mini')
                                </div></td>
                            <td class="rating">
                                <div class="div1">
                                    <h3 class="green">{{$count_jas}}</h3> <p>Общее количество<br/>событий ПБ</p>
                                    @include('charts.opo.chart_pb_event_mini')
                                </div></td>
                        </tr>

                        </tbody>
                    </table>
                </div>

            </div>
        </section>
    </div>


    <div class="tab two_col_tab" style="100px">
        <input type="radio" id="pk_rate" name="tab_group">
        <label for="pk_rate" class="tab_title">Оценка проведения ПК</label>
        <section class="tab_content">
            <div class="inside_tab_padding" style="height: 450px">
                <div class="tech_passport_tab rate_page">
                    <div class="tabs-container">
                        <ul class="tabs">
                            <li class="active"><a class="ret" href="">Оценка эффективности</a></li>
                            <li><a class="ret" href="">Показатель безопасности ОПО</a></li>
                            <li><a class="ret" href="">Показатель безаварийности ОПО</a></li>
                            <li><a class="ret" href="">Показатель готовности организации ОПО</a></li>
                        </ul>
                        <div class="tabs-content">
                            <div class="tabs-panel active" data-index="0">
                                <h4>Расчет оценки эффективности ПК </h4>
                                @include('charts.effect_apk.Performance_apk')
                                <div class="inform">
                                    <div class="inform_left">
                                        <table class="opo_info">
                                            <tbody>
                                            <tr><td>Процесс эффективен</td><td>Больше 0,9</td></tr>
                                            <tr><td>Область перспективного развития ПК</td><td>От 0,7 до 0,9</td></tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="inform_right">
                                        <table class="opo_info">
                                            <tbody>
                                            <tr><td>Область улучшения</td><td>От 0,5 до 0,7</td></tr>
                                            <tr><td>Требуется разработка и реализация <br/>корректирующих действий</td><td></td></tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="tabs-panel" data-index="1">
                                <h4>Расчет показателя безопасности ОПО</h4>
                                @include('charts.effect_apk.safety_indicator')

                                <div>
                                    <h4>Данные ручного ввода для расчета</h4>
                                    <div class="bat_add" style="margin-top: 7px"><a href="{{"/opo/".$id."/main/new_safety"}}">Добавить данные</a></div>
                                </div>
                                <div>
                                <table style="margin-top: 15px">

                                    <thead>
                                    <tr>
                                        <th style="text-align: center">Год </th>
                                        <th style="text-align: center">Квартал</th>
                                        <th style="text-align: left"></th>
                                    </tr>

                                    </thead>
                                    <tbody>
                                    @foreach ($oper_safety as $data)
                                    <tr>
                                        <td style="text-align: center">{{ $data->year }}</td>
                                        <td style="text-align: center">{{ $data->quarter }}</td>
                                        <td style="align: left">
                                            <a href={{route('operational.edit', $id_row = $data->id)}}><img  alt="" src="{{asset('assets/images/icons/edit.svg')}}" style="width: 15px; height: 15px; margin-top:3px; margin-left: 25px"></a>
                                            <a href="{{ route('operational.show',$id_row = $data->id) }}"><img  alt="" src="{{asset('assets/images/icons/search.svg')}}" style="width: 15px; height: 15px; margin-top:3px; margin-left: 25px"></a>
                                            {!! Form::open(['method' => 'DELETE','route' => ['operational.destroy', $id_row = $data->id],'style'=>'display:inline']) !!}
                                            <input type="image" name="picture" src="{{asset('assets/images/icons/trash.svg')}}" style="width: 15px; height: 15px; margin-top:3px; margin-left: 25px" />
                                            {!! Form::close() !!}
                                        </td>
                                    </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                                </div>


                            </div>
                            <div class="tabs-panel" data-index="2">
                                <h4>Расчет показателя безаварийности ОПО</h4>
                                @include('charts.effect_apk.Accident-free_indicator')

                                <div>
                                    <h4>Данные ручного ввода для расчета</h4>
                                    <div class="bat_add" style="margin-top: 7px"><a href="{{"/opo/".$id."/main/new_failure_free"}}">Добавить данные</a></div>
                                </div>
                                <div>
                                    <table style="margin-top: 15px">

                                        <thead>
                                        <tr>
                                            <th style="text-align: center">Год </th>
                                            <th style="text-align: center">Квартал</th>
                                            <th style="text-align: left"></th>
                                        </tr>

                                        </thead>
                                        <tbody>
                                        @foreach ($failure_free as $data)
                                            <tr>
                                                <td style="text-align: center">{{ $data->year }}</td>
                                                <td style="text-align: center">{{ $data->quarter }}</td>
                                                <td style="align: left">
                                                    <a href={{route('failure_free.edit', $id_row = $data->id)}}><img  alt="" src="{{asset('assets/images/icons/edit.svg')}}" style="width: 15px; height: 15px; margin-top:3px; margin-left: 25px"></a>
                                                    <a href="{{ route('failure_free.show',$id_row = $data->id) }}"><img  alt="" src="{{asset('assets/images/icons/search.svg')}}" style="width: 15px; height: 15px; margin-top:3px; margin-left: 25px"></a>
                                                    {!! Form::open(['method' => 'DELETE','route' => ['failure_free.destroy', $id_row = $data->id],'style'=>'display:inline']) !!}
                                                    <input type="image" name="picture" src="{{asset('assets/images/icons/trash.svg')}}" style="width: 15px; height: 15px; margin-top:3px; margin-left: 25px" />
                                                    {!! Form::close() !!}
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>

                            </div>
                            <div class="tabs-panel" data-index="3">
                                <h4>Расчет показателя готовности организации и персонала ОПО к локализации аварий и инцидентов</h4>
                                @include('charts.effect_apk.Readiness_indicator')

                                <div>
                                    <h4>Данные ручного ввода для расчета</h4>
                                    <div class="bat_add" style="margin-top: 7px"><a href={{"/opo/".$id."/main/new_ready"}}>Добавить данные</a></div>
                                </div>
                                <div>
                                    <table style="margin-top: 15px">

                                        <thead>
                                        <tr>
                                            <th style="text-align: center">Год </th>
                                            <th style="text-align: center">Квартал</th>
                                            <th style="text-align: left"></th>
                                        </tr>

                                        </thead>
                                        <tbody>
                                        @foreach ($ready as $data)
                                            <tr>
                                                <td style="text-align: center">{{ $data->year }}</td>
                                                <td style="text-align: center">{{ $data->quarter }}</td>
                                                <td style="align: left">
{{--                                                    <a href="{{route('ready.edit',$data->id)}}"><img  alt="" src="{{asset('assets/images/icons/edit.svg')}}" style="width: 15px; height: 15px; margin-top:3px; margin-left: 25px"></a>--}}
                                                    {!! Form::open(['method' => 'GET','route' => ['ready.edit', $id_row = $data->id],'style'=>'display:inline']) !!}
                                                    <input type="image" name="picture" src="{{asset('assets/images/icons/edit.svg')}}" style="width: 15px; height: 15px; margin-top:3px; margin-left: 25px" />
                                                    <input type="hidden" name="from_opo" value="{{ $id }}">
                                                    {!! Form::close() !!}


{{--                                                    <a href="{{ route('ready.show',$id_row = $data->id) }}"><img  alt="" src="{{asset('assets/images/icons/search.svg')}}" style="width: 15px; height: 15px; margin-top:3px; margin-left: 25px"></a>--}}
                                                    {!! Form::open(['method' => 'GET','route' => ['ready.show', $id_row = $data->id],'style'=>'display:inline']) !!}
                                                    <input type="image" name="picture" src="{{asset('assets/images/icons/search.svg')}}" style="width: 15px; height: 15px; margin-top:3px; margin-left: 25px" />
                                                    <input type="hidden" name="from_opo" value="{{ $id }}">
                                                    {!! Form::close() !!}


                                                    {!! Form::open(['method' => 'DELETE','route' => ['ready.destroy', $id_row = $data->id],'style'=>'display:inline']) !!}
                                                    <input type="image" name="picture" src="{{asset('assets/images/icons/trash.svg')}}" style="width: 15px; height: 15px; margin-top:3px; margin-left: 25px" />
                                                    <input type="hidden" name="from_opo" value="{{ $id }}">
                                                    {!! Form::close() !!}
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
        </section>
    </div>

</div>





<script>

    function get_active_page(){
        var active_element_id=localStorage.getItem('active')
        if (active_element_id!=null){
            var element=document.getElementById(active_element_id)
            element.checked=true;
        }
        else{
            var opo_info=document.getElementById('opo_info');
            opo_info.checked=true;
        }
    }

    function to_localstorage(element){
        localStorage.setItem('active', element.id)
    }

    function get_active_page_mini(){
        var active_element_mini_id=localStorage.getItem('active_mini')
        if (active_element_mini_id!=null){
            try{
                var element_mini=document.getElementById(active_element_mini_id)
                element_mini.className='active';
            }
            catch (err){
                console.log(err)
            }

        }
        else{
            try{
                var first_page=document.getElementById('0');
                first_page.className='active';
            }
            catch (err){
                console.log(err)
            }

        }
    }
    function to_localstorage_mini(element_mini){
        console.log(element_mini.id)
        localStorage.setItem('active_mini', element_mini.id)
    }

    document.addEventListener('DOMContentLoaded', function (){
        get_active_page()
        get_active_page_mini()


    })



</script>

@include('web.include.script-lib.am4')
@include('web.include.script-lib.highcharts')








