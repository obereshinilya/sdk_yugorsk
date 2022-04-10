<script>
    mapPage=true;
</script>

<div class="map_content">
{{--    <p style="text-align: center; font-size: 42px;color: #1d68a7;" class="bold blue_text">Ситуационная карта ПАО Газпром</p>--}}
{{--    <p  class="bold ">Ситуационная карта ПАО Газпром</p>--}}
    <div class="map_bottom centered">

        <div class="high_risk risk_color"><span></span> Высокий риск аварии (s0.2)</div>
        <div class="middle_risk risk_color"><span></span> Средний риск аварии (s0.5)</div>
        <div class="low_risk risk_color"><span></span> Предпосылка к инциденту (s0.8)</div>
        <div class="no_risk risk_color"><span></span> Штатно (s1)</div>
        <div class="bad_info_risk risk_color"><span></span> Недостоверные данные </div>

    </div>

    @livewire('map-gda')
    @livewire('show-gda')

</div>

{{--<div id="open_window" class="dlg-modal dlg-modal-slide" style="height: 14%; width: 20%">--}}
{{--    <div class="form_header">--}}
{{--        <span class="closer_btn" data-close="" ></span>--}}
{{--        <h3>Внимание!<br> Пароль от учетной записи необходимо обновить</h3>--}}
{{--    </div>--}}
{{--</div>--}}
{{--<div class="overlay" data-close=""></div>--}}
<div id="change_password_message_content" style="text-align: center">
    <h3>Пароль от учетной записи необходимо обновить!</h3>
</div>


<script>
    document.addEventListener('DOMContentLoaded', function test() {
        var content=document.getElementById('change_password_message_content')
        var mod=new ModalWindow('ВНИМАНИЕ',content, AnimationsTypes['slideIn'])
        if ({{$check_date_password}}==1){
            mod.show();
        }
        {{--//-------------ДИАЛОГ----------------//--}}
        {{--const overlay = document.querySelector('.overlay'),--}}
        {{--    modals = document.querySelectorAll('.dlg-modal:not(#new_jas_1_modal)'),--}}
        {{--    mClose = document.querySelectorAll('[data-close]:not(.new_jas_1_modal_close_btn)');--}}
        {{--let	mStatus = false;--}}

        {{--for (let el of mClose) {--}}
        {{--    el.addEventListener('click', modalClose);--}}
        {{--}--}}

        {{--document.addEventListener('keydown', modalClose);--}}

        {{--function modalShow(modal) {--}}
        {{--    overlay.className='overlay fadeIn';--}}
        {{--    modal.className='dlg-modal dlg-modal-slide slideInDown';--}}

        {{--    mStatus = true;--}}
        {{--}--}}

        {{--function modalClose(event) {--}}
        {{--    function close(){--}}
        {{--        for (let modal of modals) {--}}
        {{--            modal.className='dlg-modal dlg-modal-slide slideOutUp'--}}

        {{--        }--}}
        {{--        overlay.className='overlay fadeOut';--}}
        {{--        mStatus = false;--}}
        {{--    }--}}
        {{--    if (typeof event ==='undefined'){--}}
        {{--        if (mStatus){--}}
        {{--            close()--}}
        {{--        }--}}
        {{--    }--}}
        {{--    else{--}}
        {{--        if (mStatus && ( event.type != 'keydown' || event.keyCode === 27 ) ) {--}}
        {{--            close()--}}
        {{--        }--}}
        {{--    }--}}
        {{--}--}}

        {{--function open_dialog(){--}}
        {{--    var mod=document.getElementById('open_window');--}}
        {{--    console.log(mod);--}}
        {{--    modalShow(mod);--}}
        {{--}--}}

        {{--    if ({{$check_date_password}} == 1) {--}}
        {{--            open_dialog();--}}
        {{--    }--}}
    })
</script>
