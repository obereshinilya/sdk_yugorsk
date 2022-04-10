<div class="sidebar">
    <div class="inside_sidebar">
        @include('web.include.sidebar_top')
        <div class="sidebar_bottom rounded">

            <div class="sidebar_bottom_single">
                <a href="/opo/{{$ver_opo->idOPO}}">
                    <div class="clear">
                        <div class="single_fond_name rounded">
                            <p class="light_blue_text bold">{{$ver_opo->descOPO}}</p>
                            <p class="grey_text">ООО "Газпром добыча Астрахань"</p>
                        </div>
                        <div class="single_fond_rate clear">
                            <p class="bold dark_grey_text clear">{{$ver_opo->opo_to_calc1->first()->ip_opo}}</p>
                            <img alt="Показатель" src="{{asset('assets/images/icons/rate/good.svg')}}" class="rate_icon clear">
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <div class="divide_line"></div>
                </a>
            </div>

            @if (isset($id_obj))
            @livewire('search', ['id_opo'=>$ver_opo->idOPO, 'id_obj'=>$id_obj])
            @else
                @livewire('search', ['id_opo'=>$ver_opo->idOPO])
            @endif


        </div>
    </div>
</div>
