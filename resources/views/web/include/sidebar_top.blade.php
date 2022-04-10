<div class="sidebar_top">
    <div class="sidebar_top_single main rounded white_bg">
        <a href="{{route('gazprom')}}">
            <div class="sidebar_top_single info">
               <div class="class_rate good">1</div>
                <div class="class_name">
                   <p class="bold blue_text">ПАО Газпром</p>
                    <p class="grey_text">ПАО "Газпром"</p>
                </div>
            </div>
            <div class="more_arrow"><img alt="Далее" src="{{asset('assets/images/icons/arrow_right.svg')}}" class="more_arrow_icon"></div>
        </a>
    </div>
    <div class="sidebar_top_single main rounded white_bg">
        <a href="{{url('/opo')}}">
            <div class="sidebar_top_single info">
                <div class="class_rate good" id="min_ip_of_opo"></div>
                <div class="class_name">
                    <p class="bold blue_text">ГД Астрахань</p>
                    <p class="grey_text">ООО "Газпром добыча Астрахань"</p>
                </div>
            </div>
            <div class="more_arrow"><img alt="Далее" src="{{asset('assets/images/icons/arrow_right.svg')}}" class="more_arrow_icon"></div>
        </a>
    </div>
</div>
<script>
    function updateOpoParamsTopSingle() {
        $.ajax({
            url: '/opo_params/1',
            type: "GET",
            success: function (data) {
                $('#min_ip_of_opo').text(data['min_last'])
                var window = document.getElementById('min_ip_of_opo')
                if (data['min_last'] <= 1.00) {
                    $('#min_ip_of_opo').backgroundColor = "#49ce56";
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
        updateOpoParamsTopSingle();
        setInterval(updateOpoParamsTopSingle, 60000);
    })

</script>

{{--<script>--}}
{{--    $(document).ready(function (){--}}
{{--    //     setInterval($.ajax({--}}
{{--    //         url:"/min_opo",--}}
{{--    //         type:"GET",--}}
{{--    //         success:function(data)--}}
{{--    //         {--}}
{{--    //             $('#min_ip_of_opo').text(data['min_last'])--}}
{{--    //             var window = document.getElementById('min_ip_of_opo')--}}
{{--    //             if (data['min_last'] <= 1.00) {--}}
{{--    //                 window.style.backgroundColor = "#49ce56";--}}
{{--    //             }--}}
{{--    //             if (data['min_last'] <= 0.80) {--}}
{{--    //                 window.style.backgroundColor = "#ffca45";--}}
{{--    //             }--}}
{{--    //             if (data['min_last'] <= 0.50) {--}}
{{--    //                 window.style.backgroundColor = "#f58b2c";--}}
{{--    //             }--}}
{{--    //             if (data['min_last'] <= 0.20) {--}}
{{--    //                 window.style.backgroundColor = "#f26161";--}}
{{--    //             }--}}
{{--    //         }--}}
{{--    //     }), 60000);--}}
{{--    //--}}
{{--    // })--}}
{{--</script>--}}
