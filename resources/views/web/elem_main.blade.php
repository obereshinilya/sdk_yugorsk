@extends('web.layouts.app')
@section('title')
    Элемент ОПО
@endsection

@section('content')


@include('web.include.tb.sidebar_tb')


    <div class="top_table">
   @include('web.include.toptable')

    </div>
<div class="inside_content">
@include('web.include.numbs_line')
@include('web.include.obj.tabs_obj')

</div>


<script>
    function updateOpoParams(){
        var sidebar_rounded=$('#sidebar_bottom_rounded');


        $.ajax({
            url:'/opo_params/{{$id_opo}}',
            type:"GET",
            success:function(data){
                // console.log(data);
                // sidebar_rounded.html('')

                var sidebar_html='';
                for (var opo_val of data['opo']){
                    if ({{$id_opo}}==opo_val['idOPO']){
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
