<div class="tab">
    <input type="radio" id="tech_scheme" name="tab_group">
    <label for="tech_scheme" class="tab_title three_col_tab">Технологическая схема ТБ</label>
    <section class="tab_content">
        <div class="inside_tab_padding">
            <div class="row_block">
                <div class="tech_scheme_left">
                    <p class="title">{{$name_tb}}</p>
                    <div class="tech_scheme_line"></div>
                    <p class="descript">{{trim(trim($shema, "storage/"), "pdf/")}}</p>
                    <a href="{{$shema}}" download="" class="download_scheme">Скачать <img alt="" src="{{asset('assets/images/icons/download.svg')}}"></a>
                </div>
                <div class="tech_scheme_right">
{{--                    <img alt="" src="{{asset('replace/scheme.png')}}" class="replace">--}}
                    <object width="1000" height="450" type="application/pdf" data="{{asset("$shema".'?#zoom=50&scrollbar=0&toolbar=0&navpanes=0')}}">
{{--                        {{$id_tb}}--}}
                        <p>Для данного ТБ схема отсутствует</p>
                    </object>
                </div>
            </div>
        </div>
    </section>
</div>
