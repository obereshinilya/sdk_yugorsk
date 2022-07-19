
<script src="{{asset('/calendarEvents/datetimepicker/moment-with-locales.min.js')}}"></script>
<script src="{{asset('/calendarEvents/datetimepicker/bootstrap.min.js')}}"></script>
<script src="{{asset('/calendarEvents/datetimepicker/bootstrap-datetimepicker.min.js')}}"></script>
<link rel="stylesheet" href="{{asset('/calendarEvents/datetimepicker/bootstrap.css')}}">
<link rel="stylesheet" href="{{asset('/calendarEvents/datetimepicker/bootstrap-datetimepicker.css')}}">



<div class="sidebar">
        @include('web.include.sidebar_top')

        <div class="clearfix"></div>

        <div class="sidebar_bottom rounded ">

            <div class="blocks_list">

                <label class="accordion">
                    <input type='checkbox' name='checkbox-accordion' id="report" onclick="SaveChecked(this)">
                    <div class="accordion__header">
                        <a href='#'>Отчеты</a>
                    </div>
                    <div class="accordion__content">
                        <a href="/docs/actual_declarations">Реестр актуальных деклараций промышленной безопасности
                            опасных производственных объектов
                        </a>
                        <a href="/ссылка на страницу отчета 2">Наименование отчета 2 </a>
                    </div>
                </label>
            </div>
        </div>
</div>



<script>
    let checkboxes = document.getElementsByName('checkbox-accordion');
    function pageStart() {
        for (let ch of checkboxes) {
            if (window.localStorage[ch.id]){
                ch.checked=true;
            }
        }
    }

    function SaveChecked(element){
        if (window.localStorage[element.id]!=null){
            element.checked=false;
            window.localStorage.removeItem(element.id);
        }
        else {
            for (let ch of checkboxes){
                if (window.localStorage[ch.id]){
                    ch.checked=false;
                    window.localStorage.removeItem(ch.id);
                }
            }
            window.localStorage[element.id]=true;
        }

    }

    pageStart();
</script>


<style>
    .form-group {
        width: 100%;
        display: flex;
        flex-wrap: wrap;
        justify-content: space-between;
        margin: 0 0 20px;
    }


    .form-group:last-child {
        margin: 0;
    }
    .form-group label {
        display: block;
        margin: 0 0 10px;
        color: rgba(0, 0, 0, 0.6);
        font-size: 12px;
        font-weight: 500;
        line-height: 1;
        text-transform: uppercase;
        letter-spacing: 0.2em;
    }
    .form-group input {
        outline: none;
        display: block;
        background: rgba(0, 0, 0, 0.1);
        width: 100%;
        border: 0;
        border-radius: 4px;
        box-sizing: border-box;
        padding: 12px 20px;
        color: rgba(0, 0, 0, 0.6);
        font-family: inherit;
        font-size: inherit;
        font-weight: 500;
        line-height: inherit;
        transition: 0.3s ease;
    }

    .form-group input:focus {
        color: rgba(0, 0, 0, 0.8);
    }
    .form-group button {
        outline: none;
        background: #4285f4;
        width: 100%;
        border: 0;
        border-radius: 4px;
        padding: 12px 20px;
        color: #ffffff;
        font-family: inherit;
        font-size: inherit;
        font-weight: 500;
        line-height: inherit;
        text-transform: uppercase;
        cursor: pointer;
    }
</style>




