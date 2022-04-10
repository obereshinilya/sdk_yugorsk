<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
{{--    <link rel="stylesheet" href="/css/app.css">--}}

    <link rel="stylesheet" href="/css/styles.css"/>
    <link rel="stylesheet" href="/css/font-awesome.css" />
    <link rel="stylesheet" href="/css/datatable.min.css"/>
    <link rel="stylesheet" href="/css/hicharts_cercule.css"/>
    <link rel="stylesheet" href="/css/iconfont/material-icons.css" />
    <script src="/js/jquery.min.js"></script>
    <script src="/js/new.js"></script>

    <title>СДК ПБ - @yield('title')</title>
</head>
<body>
<div id="wrapper">
    <div class="content">
        @include('inc.header')
        <div id="jquery-accordion-menu" class="jquery-accordion-menu green">
            <div class="jquery-accordion-menu-header" id="form">ГД Астрахань </div>
            <ul id="demo-list">
                @include('inc.menu')

            </ul>
        </div>

        @yield('content')
    </div>
</div>
<script type="text/javascript" src="/js/new.js" ></script>

<script type="text/javascript">
    //обработчик
    jQuery(document).ready(function () {
        jQuery("#jquery-accordion-menu").jqueryAccordionMenu();

    });
    //активный класс
    $(function(){
        $("#demo-list li").click(function(){
            //  var clickId = $(this).attr('id');
            //  alert( "Вызвано событие .click()   " + clickId );
            $("#demo-list li.active").removeClass("active")
            $(this).addClass("active");

        })
    })

    $('tr').each(function(){
        $(this).find('td').each(function(){
            if ($(this).html() == 'C1') {
                $(this).parent('tr').addClass('empty1');
                return false;
            }
            if ($(this).html() == 'C2') {
                $(this).parent('tr').addClass('empty2');
                return false;
            }
        });
    });
</script>


</body>
</html>
