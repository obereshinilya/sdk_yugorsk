<section class="tab_content">
    <div class="inside_tab_padding">
        <div class="tech_passport_tab">
            @foreach ($events as $event)
            <div class="glossary_sigle">
                 @if($event->id == 1)
                <div class="class_icon red">С1</div>
                    <div class="class_name"><b>Аварийные условия функционирования</b><br/>
                @elseif($event->id == 2)
                            <div class="class_icon yellow">С2</div>
                            <div class="class_name"><b>Предаварийные условия функционирования</b><br/>
                @elseif($event->id == 3)
                            <div class="class_icon light_yellow">С3</div>
                            <div class="class_name"><b>Нормальные условия функционирования с предпосылкой к инциденту</b><br/>
                @elseif($event->id == 4)
                            <div class="class_icon green">С4</div>
                            <div class="class_name"><b>Нормальные условия функционирования</b><br/>
                @endif



                                {{$event->class}}</div>
                <div class="class_info">{{$event->descr_class}} </div>
            </div>
            @endforeach

        </div>
    </div>
</section>