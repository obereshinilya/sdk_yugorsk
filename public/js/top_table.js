
document.addEventListener('DOMContentLoaded', function (){
    var modal_content=document.getElementById('new_jas_1_modal_content')
    var modal=new ModalWindow('Внимание, новое событие', modal_content, AnimationsTypes['justMe'], false, true, 'asd')
// modal.set_overlay_background_color('white');
    modal.set_button_background_color_on_justme('#4285f4');
    // console.log(mapPage);
    if (typeof (mapPage) == 'undefined') {
        getDbInfo();
    }

    function sleep(sec) {
        return new Promise(resolve => setTimeout(resolve, sec*1000));
    }


    function clearTable(table){
        while(table.rows.length > 0) {
            table.deleteRow(table.rows.length-1);
        }
    }

    function addRowToTable(table, item, button=false){
        var row=document.createElement("tr");

        var td_date=document.createElement("td");
        td_date.className="td_date";
        var date_text=document.createTextNode(item["date"]);
        td_date.appendChild(date_text);

        var td_status=document.createElement("td");
        td_status.className="td_status";
        var status_text=document.createElement('a')
        status_text.textContent=item["level"]
        // console.log('level', item['level'])
        // if (item['level']==='C1'){
        //     status_text.href='/xml_svr';
        // }
        // if (item['level']==='С2'){
        //     status_text.href='/xml_ssr'
        // }
        td_status.appendChild(status_text);

        var td_opo=document.createElement("td");
        td_opo.className="td_opo";
        var opo_text=document.createTextNode(item["descOPO"]);
        td_opo.appendChild(opo_text);

        var td_element=document.createElement("td");
        td_element.className="td_element";
        var element_text=document.createTextNode(item["nameObj"]+`. (Элемент объекта ОПО ${item["descOPO"]})`);
        td_element.appendChild(element_text);

        var td_number=document.createElement("td");
        td_number.className="td_number";
        var number_text=document.createTextNode(item["status"]);
        td_number.appendChild(number_text);

        var td_event=document.createElement("td");
        td_event.className="td_event";
        var event_text=document.createTextNode(item["name"]);
        td_event.appendChild(event_text);

        td_date.addEventListener('click', go_to);
        td_status.addEventListener('click', go_to);
        td_opo.addEventListener('click', go_to);
        td_element.addEventListener('click', go_to);
        td_number.addEventListener('click', go_to);
        td_event.addEventListener('click', go_to);

        row.appendChild(td_date);
        row.appendChild(td_status);
        row.appendChild(td_opo);
        row.appendChild(td_element);
        row.appendChild(td_number);
        row.appendChild(td_event);

        function go_to(){
            var href='#'
            if (item['level']=='С2'){
                href='/xml_ssr';
            }
            if (item['level']=='C1'){
                href='/xml_svr';
            }
            document.location.href=href;
        }

        if (button){
            var td_confirm=document.createElement("button")
            td_confirm.className="td_confirm_btn";
            td_confirm.id=item['id'];
            td_confirm.type="button";
            td_confirm.textContent="Квитировать"

            row.appendChild(td_confirm)
        }

        table.appendChild(row);
    }

    var ids_to_kv=[];


    async function getDbInfo(){
        $.ajaxSetup({
            headers:{
                'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
            }
        });
        while(true){
            $.ajax({
                url:'/opo/get_sum/all',
                type:'GET',
                success:function(data){
                    // console.log(data)
                    var new_sum=data;//Принимаем данные в json
                    var old_sum=getFromLocalStorage('sum');
                    if (old_sum==null || old_sum!==new_sum) {
                        setToLocalStorage('sum', new_sum);
                        get_data();
                    }
                }
            })
            function get_data(){
                $.ajax({
                    url:"/opo/getjas1/15",
                    type:"GET",
                    success:function(data)
                    {
                        var tabBody = document.getElementById("top_table_inside").getElementsByTagName("tbody").item(0);
                        clearTable(tabBody);
                        var arr=JSON.parse(data);
                        arr.forEach(function(item, i, arr) {
                            if (typeof tablePage !== 'undefined') {
                                addRowToTable(tabBody, item);
                            }

                        });

                    }
                })


                $.ajax({
                    url:"/opo/getjas1/0",
                    type:"GET",
                    success:function(data)
                    {

                        var dialTabBody = document.getElementById("new_jas_1_modal_content").getElementsByTagName("tbody").item(0);
                        clearTable(dialTabBody);


                        var arr=JSON.parse(data);
                        var new_data_flag=false;

                        if (arr[0].length!==0) {
                            arr.forEach(function (item, i, arr) {
                                ids_to_kv.push(item['id']);
                                new_data_flag = true;
                                addRowToTable(dialTabBody, item, true);
                            });
                        }

                        if (new_data_flag){
                            ShowAlert();
                        }
                    }
                })
            }

            await sleep(60);
        }
    }

    function getFromLocalStorage(key){
        return window.localStorage ? window.localStorage[key] : null
    }

    function setToLocalStorage(key, value){
        if (window.localStorage){
            window.localStorage[key]=value;
        }
    }

    function ShowAlert(){
        // console.log('SHOWALERT')
        modal.show()

        // const mClose = document.querySelectorAll('[data-close]');
        // let	mStatus = false;
        // var overlay = document.querySelector('.not_click_overlay');
        // var modal = document.getElementById("new_jas_1_modal");
        // modalShow(modal);
        //
        // for (let el of mClose) {
        //     el.addEventListener('click', modalClose);
        // }
        //
        // function modalShow(modal) {
        //
        //     // показываем подложку всплывающего окна
        //     overlay.classList.remove('fadeOut');
        //     overlay.classList.add('fadeIn');
        //
        //     modal.classList.remove('fadeOut');
        //     modal.classList.add('fadeIn');
        //
        //     mStatus = true;
        // }
        //
        // function modalClose() {
        //     if (mStatus) {
        //         modal.classList.remove('fadeIn');
        //         modal.classList.add('fadeOut');
        //         overlay.classList.remove('fadeIn');
        //         overlay.classList.add('fadeOut');
        //         // сбрасываем флаг, устанавливая его значение в 'false'
        //         // это значение указывает нам, что на странице нет открытых
        //         // всплывающих окон
        //         mStatus = false;
        //     }
        // }

        // confirmBtn=document.getElementById("kvitir");
        // confirmBtn.addEventListener('click');

        var kv_buttons=document.getElementsByClassName("td_confirm_btn");
        for (let el of kv_buttons) {
            el.addEventListener('click', function (e){
                Confirm(el);
            });
        }

        function Confirm(button){
            var _id="id="+encodeURIComponent(button.id);
            var request= new XMLHttpRequest();
            request.onreadystatechange=function (){
                if ((request.readyState==4) && (request.status==200)) {
                    var res=JSON.parse(request.responseText);
                    // console.log(request.responseText);
                    if (res['result']=='true'){
                        td_confirm_res=document.createElement("td");
                        td_confirm_res.textContent="Успешно";
                        button.parentNode.replaceChild(td_confirm_res, button);
                        deleteFromArray(kv_buttons, button);
                        if (kv_buttons.length==0){
                            modalClose();
                        }
                    }
                }
            }

            request.open('POST', "/opo/set_check_for_opo",true);
            request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            request.setRequestHeader('X-CSRF-TOKEN', $('meta[name="csrf-token"]').attr('content'));
            request.send(_id);

        }


    }

    function deleteFromArray(array, element){
        for (let item of array){
            if (item==element){
                array.slice(item.id,1);
                return true;
            }
        }
        return false;

    }

    if (getFromLocalStorage('sum')!=null){
        window.localStorage.removeItem('sum');
    }
})

