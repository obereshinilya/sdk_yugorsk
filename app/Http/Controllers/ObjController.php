<?php

namespace App\Http\Controllers;

use App\Http\Livewire\EventTypes;
use App\Models\APK_SDK;
use App\Models\Cs1que;
use App\Models\JasBuf;
use App\Models\Matrix\DangerousEvent;
use App\Models\Matrix\Event_types;
use App\Models\Ref_obj;
use App\Models\Ref_oto;
use App\Models\Status_obj;
use App\Models\Type_obj;
use App\Models\Wells1que;
use App\Models\Wells2que;
use App\Models\Wells_type;
use App\Ref_opo;
use App\Models\Tech_reg\Tech_reglament;
use Carbon\Carbon;
use Illuminate\Http\Request;
use PDF;

class ObjController extends Controller
{









    public function view_elem_main ($id_opo, $id_obj)
//       ********************** Вывести схему на страницу Конкретного ОПО по ИД *****************************
    {
        $jas = OpoController::view_jas_15();     // Жас всех ОПО 15 записей
        $ver_opo =  Ref_opo::find($id_opo);  // Ссылка на ОПО
        $all_opo = Ref_opo::all(); //Сыслка на все ОПО
        $elems_opo = $ver_opo->opo_to_obj; // Перечень всех лементов ОПО
        $this_elem = Ref_obj::find($id_obj); // Ссылка на элемен
        $this_elem_apk = APK_SDK::where('idOPO', '=', $id_opo)->where('idObj', '=', $id_obj)->orderByDesc('daterec')->get();  // перечень всех несоответствий АПК по элементу
        $reglaments = Tech_reglament::all()->where('idObj', '==', $this_elem->typeObj);
//работа над текстом в всплывашки chart_mini
        $text['chart_1'] = '';
        $text['chart_2'] = [];
        $text['chart_3'] = [];
        $text['chart_4'] = '';
        //ДЛЯ CHART_1
        if ($this_elem->elem_to_calc->first()->ip_elem < 0.8){
            if(($this_elem->elem_to_calc->first()->op_m <= $this_elem->elem_to_calc->first()->op_r) && ($this_elem->elem_to_calc->first()->op_m <= $this_elem->elem_to_calc->first()->op_el)){
                $text['chart_1'] = 'Влияние обобщенного показателя по комплексным сценариям (Равен'.' '.$this_elem->elem_to_calc->first()->op_m.' )';
            } elseif (($this_elem->elem_to_calc->first()->op_r <= $this_elem->elem_to_calc->first()->op_m) && ($this_elem->elem_to_calc->first()->op_r <= $this_elem->elem_to_calc->first()->op_el)){
                $text['chart_1'] = 'Влияние обобщенного показателя превышения пределов безопасности технологического процесса (Равен'.' '.$this_elem->elem_to_calc->first()->op_r.' )';
            } else{
                $text['chart_1'] = 'Влияние обобщенного показателя технического риска ПБ элемента ОПО (Равен'.' '.$this_elem->elem_to_calc->first()->op_el.' )';
            }
        }
        //ДЛЯ CHART_2
        $jas_buf = JasBuf::orderBydesc('id')->where('from_elem_opo', $id_obj)->get();
        $i = 0;
        foreach($jas_buf as $buf){
            $text['chart_2'][$i] = 'Уровень: '.$buf->level.'. Событие: '.Event_types::where('id', DangerousEvent::where('id', $buf->danger)->first()->from_tech_event_type)->first()->name.'.';
            $i++;
        }
        //ДЛЯ CHART_3
        $ochered = Ref_obj::where('idObj', $id_obj)->first()->type_project;
        if($ochered == 'W1' || $ochered == 'W1 '){
            $data_param = Wells1que::orderByDesc('daterec')->where('from_ref_obj', $id_obj)->first();
            $num_error_reglament = 0;
            foreach ($reglaments->where('wells', '=', 1) as $row){
                if ($row->min != '' && $row->max != '') {
                    $name_signal = $row->reglament_to_param->asutp_name;
                    $znachenie_tekushee = $data_param->$name_signal;
                    if ($row->min < $row->max) {
                        if ($znachenie_tekushee < $row->min || $znachenie_tekushee > $row->max) {
                            $text['chart_3']['name'][$num_error_reglament] = $row->reglament_to_param->full_name;
                            $text['chart_3']['min'][$num_error_reglament] = round($row->min, 2);
                            $text['chart_3']['max'][$num_error_reglament] = round($row->max, 2);
                            $text['chart_3']['tek'][$num_error_reglament] = round($znachenie_tekushee, 2);
                            $num_error_reglament++;
                        }
                    } else {
                        if ($znachenie_tekushee > $row->min || $znachenie_tekushee < $row->max) {
                            $text['chart_3']['name'][$num_error_reglament] = $row->reglament_to_param->full_name;
                            $text['chart_3']['min'][$num_error_reglament] = round($row->min, 2);
                            $text['chart_3']['max'][$num_error_reglament] = round($row->max, 2);
                            $text['chart_3']['tek'][$num_error_reglament] = round($znachenie_tekushee, 2);
                            $num_error_reglament++;
                        }
                    }
                }
            }
        } elseif ($ochered == 'W' || $ochered == 'W '){
            $data_param = Wells2que::orderByDesc('daterec')->where('from_ref_obj', $id_obj)->first();
            $num_error_reglament = 0;
            foreach ($reglaments->where('wells', '=', 2) as $row){
                if ($row->min != '' && $row->max != '') {
                    $name_signal = $row->reglament_to_param->asutp_name;
                    $znachenie_tekushee = $data_param->$name_signal;
                    if ($row->min < $row->max) {
                        if ($znachenie_tekushee < $row->min || $znachenie_tekushee >= $row->max) {
                            $text['chart_3']['name'][$num_error_reglament] = $row->reglament_to_param->full_name;
                            $text['chart_3']['min'][$num_error_reglament] = round($row->min, 2);
                            $text['chart_3']['max'][$num_error_reglament] = round($row->max, 2);
                            $text['chart_3']['tek'][$num_error_reglament] = round($znachenie_tekushee, 2);
                            $num_error_reglament++;
                        }
                    } else {
                        if ($znachenie_tekushee >= $row->min || $znachenie_tekushee < $row->max) {
                            $text['chart_3']['name'][$num_error_reglament] = $row->reglament_to_param->full_name;
                            $text['chart_3']['min'][$num_error_reglament] = round($row->min, 2);
                            $text['chart_3']['max'][$num_error_reglament] = round($row->max, 2);
                            $text['chart_3']['tek'][$num_error_reglament] = round($znachenie_tekushee, 2);
                            $num_error_reglament++;
                        }
                    }
                }
            }
        } else{
            $data_param = Cs1que::orderByDesc('daterec')->where('from_ref_obj', $id_obj)->first();
            $num_error_reglament = 0;
            foreach ($reglaments as $row){
                if ($row->min != '' && $row->max != '') {
                    $name_signal = $row->reglament_to_param->asutp_name;
                    $znachenie_tekushee = $data_param->$name_signal;
                    if ($row->min < $row->max) {
                        if ($znachenie_tekushee < $row->min || $znachenie_tekushee >= $row->max) {
                            $text['chart_3']['name'][$num_error_reglament] = $row->reglament_to_param->full_name;
                            $text['chart_3']['min'][$num_error_reglament] = round($row->min, 2);
                            $text['chart_3']['max'][$num_error_reglament] = round($row->max, 2);
                            $text['chart_3']['tek'][$num_error_reglament] = round($znachenie_tekushee, 2);
                            $num_error_reglament++;
                        }
                    } else {
                        if ($znachenie_tekushee >= $row->min || $znachenie_tekushee < $row->max) {
                            $text['chart_3']['name'][$num_error_reglament] = $row->reglament_to_param->full_name;
                            $text['chart_3']['min'][$num_error_reglament] = round($row->min, 2);
                            $text['chart_3']['max'][$num_error_reglament] = round($row->max, 2);
                            $text['chart_3']['tek'][$num_error_reglament] = round($znachenie_tekushee, 2);
                            $num_error_reglament++;
                        }
                    }
                }
            }
        }
        //ДЛЯ CHART_4
        $type_obj = $this_elem->typeObj;
        $OTO = Ref_oto::where('typeObj', $type_obj)->get();   //связь с ТБ
        $n_to_min = 1; //показатель ТО
        $n_h_tu_min = 1; //показатель изм надежности
        $n_fp_tu_min = 1; //показатель безопасности эксплуатации
        $n_fapk_min = 1; //отклоний АПК ПБ
        $idOTO_n_to_min = 0;
        $idOTO_n_h_tu_min = 0;
        $idOTO_n_fp_tu_min = 0;
        $idOTO_n_fapk_min = 0;
        foreach ($OTO as $tb){
            $this_calc_tb = $this_elem->elem_to_calc_tb->where('from_oto', '=', $tb->idOTO)->first();
            if ($this_calc_tb->n_to <= $n_to_min){
                $n_to_min = $this_calc_tb->n_to;
                $idOTO_n_to_min = $tb->idOTO;
            }
            if($this_calc_tb->n_h_tu <= $n_h_tu_min){
                $n_h_tu_min = $this_calc_tb->n_h_tu;
                $idOTO_n_h_tu_min = $tb->idOTO;
            }
            if ($this_calc_tb->n_fp_tu <= $n_fp_tu_min){
                $n_fp_tu_min = $this_calc_tb->n_fp_tu;
                $idOTO_n_fp_tu_min = $tb->idOTO;
            }
            if ($this_calc_tb->n_fapk <=$n_fapk_min){
                $n_fapk_min = $this_calc_tb->n_fp_tu;
                $idOTO_n_fapk_min = $tb->idOTO;
            }
        }
        $calc = [$n_to_min => $idOTO_n_to_min,
                $n_h_tu_min => $idOTO_n_h_tu_min,
                $n_fp_tu_min => $idOTO_n_fp_tu_min,
                $n_fapk_min => $idOTO_n_fapk_min
                ];
        ksort($calc);
        $key = array_key_first($calc);
        $idOTO = $calc[$key];
        if ($key != 1){
            $text['chart_4'] = 'Обусловлено расчетными показателем ТБ "'.$OTO->where('idOTO', $idOTO)->first()->descOTO.'" (Минимальный = '.$key.')';
        }
//        dd($text);
        return view('web.elem_main', compact('jas', 'ver_opo', 'elems_opo', 'this_elem', 'id_obj', 'this_elem_apk', 'all_opo', 'reglaments', 'text', 'id_opo'));

    }

    public function get_charts_vals($id_obj){
        $this_elem = Ref_obj::find($id_obj);
        $ip_elem=$this_elem->elem_to_calc->first()->ip_elem;
        $op_m=$this_elem->elem_to_calc->first()->op_m;
        $op_r=$this_elem->elem_to_calc->first()->op_r;
        $op_el=$this_elem->elem_to_calc->first()->op_el;

        return array('ip_elem'=>$ip_elem,
                    'op_m'=>$op_m,
                    'op_r'=>$op_r,
                    'op_el'=>$op_el);
    }
    //*************************  Вывод для графика 40 значений ip_elem   *************************************
    public function calc_elem_all ( $id_obj)
    {

        foreach (Ref_obj::find($id_obj)->elem_to_calc_40 as $row)
        {
            $my[] =array (strtotime($row->date.'+ 4 hours')*1000, $row->ip_elem);

        }
        return str_replace('"','',json_encode(array_reverse($my, false)));
     }
     //*************************  Вывод для графика 40 значений op_m   *************************************
    public function calc_elem_op_m ( $id_obj)
    {

        foreach (Ref_obj::find($id_obj)->elem_to_calc_40 as $row)
        {
            $my[] =array (strtotime($row->date.'+ 4 hours')*1000, $row->op_m);

        }
        return str_replace('"','',json_encode(array_reverse($my, false)));
     }
     //*************************  Вывод для графика 40 значений op_r   *************************************
    public function calc_elem_op_r ( $id_obj)
    {

        foreach (Ref_obj::find($id_obj)->elem_to_calc_40 as $row)
        {
            $my[] =array (strtotime($row->date.'+ 4 hours')*1000, $row->op_r);

        }
        return str_replace('"','',json_encode(array_reverse($my, false)));
     }     //*************************  Вывод для графика 40 значений op_el   *************************************
    public function calc_elem_op_el ( $id_obj)
    {

        foreach (Ref_obj::find($id_obj)->elem_to_calc_40 as $row)
        {
            $my[] =array (strtotime($row->date.'+ 4 hours')*1000, $row->op_el);

        }
        return str_replace('"','',json_encode(array_reverse($my, false)));
     }
     public function pdf_download ($id_obj)
     {
         $this_elem = Ref_obj::find($id_obj); // Ссылка на элемент
         $data['title'] = $this_elem->descObj.' '.$this_elem->nameObj.' ОПО №'.$this_elem->idOPO;
         $data['this_elem'] = Tech_reglament::all()->where('idObj', '==', $this_elem->typeObj);
         $patch = 'Технологический регламент'.$this_elem->descObj.'_'.$this_elem->nameObj.'.pdf';
         $pdf = PDF::loadView('web.include.obj.pdf.pdf_tech_reg', $data);//->setPaper('a4', 'landscape');
         return $pdf->download($patch);
     }

    //******************** Справочник элементов ОПО ****************************

    public function show_Obj_all()

    {
        $data = Ref_obj::orderBy('idObj')->where('idOPO', '>', '0')->get();
        AdminController::log_record('Открыл справочник элементов ОПО');//пишем в журнал
        return view('web.docs.matrix.infoObj.index', compact('data'));
    }
    public function edit_Obj($idObj)
    {
        $data = Ref_obj::find($idObj);
        $data_all = Wells_type::all();
        $data_opo = Ref_opo::all();
        $data_obj_type = Type_obj::all();
        $data_status = Status_obj::all();
        AdminController::log_record('Открыл для редактирования запись в справочнике элементов ОПО');//пишем в журнал
        return view('web.docs.matrix.infoObj.edit',compact('data', 'data_all', 'data_opo', 'data_obj_type', 'data_status'));
    }
    public function update_Obj(Request $request, $idObj)
    {
        $input = $request->all();
        $data = Ref_obj::find($idObj);
        $data->update($input);
        AdminController::log_record('Сохранил после редактирования запись в справочнике элементов ОПО');//пишем в журнал
        return redirect("/docs/infoObj");
    }
    public function show_Obj($idObj)
    {
        $data = Ref_obj::find($idObj);
        $data_all = Wells_type::all();
        $data_opo = Ref_opo::all();
        $data_obj_type = Type_obj::all();
        $data_status = Status_obj::all();
        AdminController::log_record('Открыл для просмотра запись о элементе ОПО');//пишем в журнал
        return view('web.docs.matrix.infoObj.show',compact('data', 'data_all', 'data_opo', 'data_obj_type', 'data_status'));
    }
    public function create_Obj()
    {
        $data_all = Wells_type::all();
        $data_opo = Ref_opo::all();
        $data_obj_type = Type_obj::all();
        $data_status = Status_obj::all();
        return view('web.docs.matrix.infoObj.create',compact('data_all', 'data_opo', 'data_obj_type', 'data_status'));
    }
    public function store_Obj(Request $request)
    {
        $input = $request->all();
        $input['guid'] = sprintf('%04X%04X-%04X-%04X-%04X-%04X%04X%04X', mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(16384, 20479), mt_rand(32768, 49151), mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535));
        $predRTN = Ref_obj::create($input);
        AdminController::log_record('Создал запись в справочнике элементов ОПО');//пишем в журнал
        return redirect('/docs/infoObj');
    }
    public function delete_Obj($idObj)
    {
        Ref_obj::find($idObj)->delete();
        AdminController::log_record('Удалил запись в справочнике элементов ОПО');//пишем в журнал
        return redirect('/docs/infoObj');
    }
}
