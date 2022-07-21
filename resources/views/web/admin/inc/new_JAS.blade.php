<div id="jda_attention_modal_content" style="text-align: center; width: auto; height: auto">
    <div class="prokrutka">
        <div style="background: #FFFFFF; text-align: center" class="form51">
            <table id="itemInfoTable_jas" style="display: none">
                <thead>
                <tr>
                    <th style="text-align: center">Дата</th>
                    <th style="text-align: center">Статус</th>
                    <th style="text-align: center">ОПО</th>
                    <th style="text-align: center">Элемент ОПО</th>
                    <th style="text-align: center">Событие</th>
                </tr>
                </thead>
                <tbody>

                </tbody>
            </table>
        </div>
    </div>
    <a id="button_new_jas" class="btn btn-danger" style="text-decoration: none; margin-top: 20px; display: none" href="/jas_full">Перейти в журнал аварийных событий</a>
</div>


<script>
    document.addEventListener('DOMContentLoaded', function test() {
        check_new_JAS()
        setInterval(check_new_JAS ,30000)
    })

    function check_new_JAS(){
        $.ajax({
            url:'/check_new_JAS',
            type:'GET',
            success:(res)=>{
                if (res){
                    console.log('открываем')
                    var modal_content=document.getElementById('jda_attention_modal_content')
                    var modal=new ModalWindow('Внимание!', modal_content, AnimationsTypes['fadeIn'])
                    document.getElementById('itemInfoTable_jas').style.display = ''
                    var table_body=document.getElementById('itemInfoTable_jas').getElementsByTagName('tbody')[0]
                    table_body.innerText=''
                    for (var i=0; i<res.length; i++){
                        var tr=document.createElement('tr')
                        tr.innerHTML+=`<td>${res[i]['date'].split('.')[0]}</td>`
                        tr.innerHTML+=`<td>${res[i]['status']}</td>`
                        tr.innerHTML+=`<td>${res[i]['opo']}</td>`
                        tr.innerHTML+=`<td>${res[i]['elem_opo']}</td>`
                        tr.innerHTML+=`<td>${res[i]['sobitie']}</td>`
                        table_body.appendChild(tr);
                    }
                    document.getElementById('button_new_jas').style.display = ''
                    modal.show()
                } else {
                    console.log('7не открываем')

                }
            }
        })
    }
</script>


<style>
    .dlg-modal{
        position: fixed;
        /*top: 20%;*/
        left: 50%;
        width: 50%;
        min-width: 800px;
        height: auto;
    }

    .prokrutka {
        max-height: 600px;
        background: #fff; /* цвет фона, белый */
        /*border: 1px solid #C1C1C1; !* размер и цвет границы блока *!*/
        /*overflow-x: scroll; !* прокрутка по горизонтали *!*/
        overflow-y: scroll; /* прокрутка по вертикали */
    }
</style>

