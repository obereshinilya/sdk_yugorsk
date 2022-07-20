<?php

namespace App\Http\Controllers;


use App\Ref_opo;
use App\Models\Ref_obj;
use App\User;
use Illuminate\Support\Facades\Auth;
use Jenssegers\Date\Date;
use Illuminate\Http\Request;



class OpoController extends Controller
{
    public function view_opo ()
    {
        AdminController::log_record('Открыл схему Краснотурьинского ЛПУ МГ');//пишем в журнал
        return view('web.opo');
    }


    //старое снизу










    public static function id_opo_from_name($opo)
//       ********************** Определение Ид по имени ОПО*****************************
    // *************************  Вывод всех данных по ОПО *************************
    {
       return  Ref_opo::all()->where('descOPO',$opo)->first();
    }
    public static function id_elem_from_name($elem)
//       ********************** Определение Ид по имени Елемента*****************************
    // *************************  Вывод всех данных по Элементу *************************
    {
      return Ref_obj::all()->where('nameObj',$elem)->last();
    }
    public static function ip_elem($id_elem)
//       ********************** Вывод последних расчетных данных по элементу*****************************
    // *************************  Вывод всех данных по Элементу *************************
    {
        $ip_elem = Calc_elem::where('from_elem',$id_elem)
            ->orderBy('id', 'desc')
            ->take(1)
        ->first();

       return $ip_elem;
    }
    public static function calc_elem($id_elem)
//       ********************** Вывод последних расчетных 20 данных по элементу*****************************

    {
        foreach (Ref_obj::find($id_elem)->elem_to_calc->take(40) as $row)
        {
            $my[] =array (strtotime($row->date)*1000, $row->op_m);

        }
//        $result_data = str_replace('"','',json_encode(array_reverse($my, false)));
        return str_replace('"','',json_encode(array_reverse($my, false)));
    }
    public static function ip_opo($id_opo)
//       ********************** Определение ИП ОПО по имени ИД*****************************
    {
        $result = Calc_opo::all()->last();
        if ($id_opo == 1) {
             $ip_opo_r = $result->ip_opo_1;

            return $ip_opo_r;
        }
         if ($id_opo == 2) {
             $ip_opo_r = $result->ip_opo_2;

            return $ip_opo_r;
        }
         if ($id_opo == 3) {
             $ip_opo_r = $result->ip_opo_3;

            return $ip_opo_r;
        }
       if ($id_opo == 4) {
             $ip_opo_r = $result->ip_opo_4;

            return $ip_opo_r;
        }
         if ($id_opo == 5) {
             $ip_opo_r = $result->ip_opo_5;

            return $ip_opo_r;
        }
         if ($id_opo == 6) {
             $ip_opo_r = $result->ip_opo_6;

            return $ip_opo_r;
        }
       if ($id_opo == 7) {
             $ip_opo_r = $result->ip_opo_7;

            return $ip_opo_r;
        }
         if ($id_opo == 8) {
             $ip_opo_r = $result->ip_opo_8;

            return $ip_opo_r;
        }
         if ($id_opo == 9 )
         {
             $ip_opo_r = $result->ip_opo_9;

            return $ip_opo_r;
        }



    }
    public static function view_jas_15()
//       ********************** Вывести последние 15 событий *****************************
    {
       return Jas::orderBy('id','DESC')->take(15)->get();
    }
     public function view_opo_main()
//       ********************** Вывести данные на страницу *****************************
    {
       $jas = OpoController::view_jas_15();
       $opo = Ref_opo::orderBy('idOPO')->get();
       $id = 2;

       return view('web.index', compact('jas', 'opo', 'id'));
    }

    public function min_ip_of_opo()
//       ********************** вытягиваем минимальное значение ИП по ОПО *****************************
    {
       $all_data_last = Calc_opo::orderByDesc('id')->first();
       $min_last = min($all_data_last['ip_opo_1'], $all_data_last['ip_opo_2'], $all_data_last['ip_opo_3'], $all_data_last['ip_opo_4'], $all_data_last['ip_opo_5'], $all_data_last['ip_opo_6'], $all_data_last['ip_opo_7'],
           $all_data_last['ip_opo_8'], $all_data_last['ip_opo_9']);
       $all_data_pred = Calc_opo::find($all_data_last->id - 1);
       $min_pred = min($all_data_pred['ip_opo_1'], $all_data_pred['ip_opo_2'], $all_data_pred['ip_opo_3'], $all_data_pred['ip_opo_4'], $all_data_pred['ip_opo_5'], $all_data_pred['ip_opo_6'], $all_data_pred['ip_opo_7'],
            $all_data_pred['ip_opo_8'], $all_data_pred['ip_opo_9']);
       $raznost = round(abs($min_last - $min_pred), 3);
       if ($min_last > $min_pred){
           $check = 1;
       } if ($min_last == $min_pred){
           $check = 2;
       } else {
           $check = 0;
       }
       $data = array(
           "min_last" => $min_last,
           "min_pred"=> $min_pred,
           "check"=> $check,
           "raznost"=> $raznost
       );
       return $data;
    }

    public function mini_graphics_opo($id)
//       ********************** для мини графиков на страницах ОПО *****************************
    {
        //для ИП ОПО
       $all_data_last = Calc_opo::orderByDesc('id')->first();
        $name_opo = "ip_opo_".$id;
       $ip_last = $all_data_last["$name_opo"];
        $all_data_pred = Calc_opo::find($all_data_last->id - 1);
        $ip_pred = $all_data_pred["$name_opo"];

       $raznost = round(abs($ip_last - $ip_pred), 3);
       if ($ip_last > $ip_pred){
           $check = 1;
       } if ($ip_last == $ip_pred){
           $check = 2;
       } else {
           $check = 0;
       }
       // для прогн. ИП ОПО
        $all_data_pro = Calc_pro_ip_opoi::orderByDesc('id')->where('from_opo', '=', $id)->where('forecast_period', '=', '0 years 0 mons 0 days 1 hours 0 mins 0.00 secs')
            ->take(2)->get();
        $last = $all_data_pro[0];
        $pred = $all_data_pro[1];
        $pro_last = $last['pro_ip_opo'];
        $pro_pred = $pred['pro_ip_opo'];
        $raznost_pro = round(abs($pro_last - $pro_pred), 3);
        if ($pro_last > $pro_pred){
            $pro_check = 1;
        } if ($pro_last == $pro_pred){
        $pro_check = 2;
        } else {
        $pro_check = 0;
        }
       $data = array(
           "check"=> $check,
           "raznost"=> $raznost,
           "pro_check"=> $pro_check,
           "raznost_pro"=> $raznost_pro
       );
       return $data;
    }

    public function view_opo_id($id)
//       ********************** Вывести данные на страницу Конкретного ОПО по ИД *****************************
    {

       //$jas = OpoController::view_jas_15();     // Жас всех ОПО 15 записей
       $opo = Ref_opo::orderBy('idOPO')->get();  // Перечень всех ОПО
       $ver_opo =  Ref_opo::find($id);
       $jas_opo =  $ver_opo->opo_to_jas;   //Журнал этого опо последние 60 записей
       $mins_opos = $ver_opo->opo_to_calc_day_min->first();
       $mins_opo_months = $ver_opo->opo_to_calc_months_min->first();
       $mins_opo_year = $ver_opo->opo_to_calc_year_min->first();

       return view('web.index', compact( 'id', 'jas_opo', 'opo', 'ver_opo', 'mins_opos', 'mins_opo_months', 'mins_opo_year'));
    }

    public function get_opo_params($id){
        $opo = Ref_opo::orderBy('idOPO')->get();  // Перечень всех ОПО
        $jas_opo =  Ref_opo::find($id)->opo_to_jas;   //Журнал этого опо последние 60 записей

        $all_data_last = Calc_opo::orderByDesc('id')->first();
        $min_last = min($all_data_last['ip_opo_1'], $all_data_last['ip_opo_2'], $all_data_last['ip_opo_3'], $all_data_last['ip_opo_4'], $all_data_last['ip_opo_5'], $all_data_last['ip_opo_6'], $all_data_last['ip_opo_7'],
            $all_data_last['ip_opo_8'], $all_data_last['ip_opo_9']);

//        $data=['opo'=>$opo, 'jas_opo'=>$jas_opo, ];
        $data=array('opo'=>array(), 'jas_opo'=>$jas_opo, 'min_last'=>$min_last);
        foreach ($opo as $opo_val){
            array_push($data['opo'], array('idOPO'=>$opo_val->idOPO,
                                                'descOPO'=>$opo_val->descOPO,
                                                'ip_opo'=>$opo_val->opo_to_calc1->first()->ip_opo));

        }
        return $data;
    }

    public function get_opo_data($id, $db_count){

        $new_count=Jas::count();
        if ($new_count==$db_count){
            $data=array('new_data'=>false);
            return json_encode($data, JSON_UNESCAPED_UNICODE);
        }else {
            $opo = Ref_opo::orderBy('idOPO')->get();  // Перечень всех ОПО
            $ver_opo = Ref_opo::find($id);
            $jas_opo = $ver_opo->opo_to_jas;   //Журнал этого опо последние 60 записей
            $mins_opos = $ver_opo->opo_to_calc_day_min->first();
            $mins_opo_months = $ver_opo->opo_to_calc_months_min->first();
            $mins_opo_year = $ver_opo->opo_to_calc_year_min->first();
            $ip_opo = $ver_opo->opo_to_calc1->first()->ip_opo;
            $all_opo_ip = array();

            $i = 0;
            foreach ($opo as $value) {
                $all_opo_ip[$i] = $value->opo_to_calc1->first()->ip_opo;
                $i += 1;
            }
            $jas_opo_data[] = array();

            $i = 0;
            foreach ($jas_opo as $value) {
                $jas_opo_data[$i]['date'] = date('d-m-Y H:i:s', strtotime($value->data));
                $jas_opo_data[$i]['level'] = $value->level;
                $jas_opo_data[$i]['descOPO'] = $value->jas_to_opo->descOPO;
                $jas_opo_data[$i]['nameObj'] = $value->jas_to_elem->nameObj;
                $jas_opo_data[$i]['status'] = $value->status;
                $jas_opo_data[$i]['name'] = $value->name;
                $jas_opo_data[$i]['check'] = $value->check;
                $jas_opo_data[$i]['id'] = $value->id;
                $i += 1;
            }

            //СТандартные исходные данные по статусам для столбовых графиков
            $day_int_status=-1;
            $day_status='Нет данных';
            $day_opos_ip_opo=0.0;
            if ($mins_opos!==null){
                $day_int_status=$mins_opos->status;
                $day_status=$mins_opos->calc_to_status->status;
                $day_opos_ip_opo=$mins_opos->ip_opo;
            }
            $months_int_status=-1;
            $months_status='Нет данных';
            $months_opos_ip_opo=0.0;
            if ($mins_opo_months!==null){
                $months_int_status=$mins_opo_months->status;
                $months_status=$mins_opo_months->calc_to_status->status;
                $months_opos_ip_opo=$mins_opo_months->ip_opo;
            }
            $year_int_status=-1;
            $year_status='Нет данных';
            $year_opos_ip_opo=0.0;
            if ($mins_opo_months!==null){
                $year_int_status=$mins_opo_year->status;
                $year_status=$mins_opo_year->calc_to_status->status;
                $year_opos_ip_opo=$mins_opo_year->ip_opo;
            }


            $data = array('new_data'=>true,
                'opo' => $opo,
                'id' => $id,
                'jas_opo' => $jas_opo_data,
                'mins_opos_int_status' => $day_int_status,
                'mins_opos_status' => $day_status,
                'mins_opos_ip_opo' => $day_opos_ip_opo,
                'mins_opo_months_int_status' => $months_int_status,
                'mins_opo_months_status' => $months_status,
                'mins_opo_months_ip_opo' => $months_opos_ip_opo,
                'mins_opo_year_int_status' => $year_int_status,
                'mins_opo_year_status' => $year_status,
                'mins_opo_year_ip_opo' => $year_opos_ip_opo,
                'ip_opo' => $ip_opo,
                'all_opo_ip' => $all_opo_ip,
                'db_count'=>$new_count
            );
            return json_encode($data, JSON_UNESCAPED_UNICODE);
        }


    }
    public function view_opo_main_shema ($id)
//       ********************** Вывести схему на страницу Конкретного ОПО по ИД *****************************
    {

       $jas = OpoController::view_jas_15();     // Жас всех ОПО 15 записей
       $ver_opo =  Ref_opo::find($id);  // Ссылка на ОПО
       $elems_opo = $ver_opo->opo_to_obj; // Перечень всех лементов ОПО
       $all_opo = Ref_opo::all(); //Сыслка на все ОПО для панели
       $oper_safety = Operational_safety::where('from_opo',$id)->orderByDesc('id')->get();
       $ready = Ready::orderByDesc('id')->get();
       $failure_free = Failure_free::where('from_opo', $id)->orderByDesc('id')->get();

       //       ********************** для количества предписаний РТН *****************************

        $data_rtn_noncheck = Rtn::where('from_opo', $id)->where('status', '!=', 'true')->get();  //кол-во невыполненных предписаний
        $data_rtn_check = Rtn::where('from_opo', $id)->where('status', 'true')->get();          //кол-во выполненных

        //       ********************** для количества событий ПБ по месяцам *****************************

        for ($i = 0; $i <= 12; $i++) {
            $first_day[$i] =  date("Y-m-01", strtotime("-".$i." month"));     //первые дни месяцев
        }
        for ($i = 1; $i <=12; $i++) {
            $jas_month[$i] = Jas::where('from_opo', $id)->where('data', '>=', $first_day[$i])->where('data', '<', $first_day[$i-1])->get();  //забираем из базы строки по месяцам
            if ($jas_month[$i] == "") {
                $jas_month[$i] = 0;
            }
            $count_month[$i] = count($jas_month[$i]);                              //количество записей за месяц
//            $name_month[$i] = date('M', strtotime($first_day[$i]));          //название месяца англ
            $name_month[$i] = Date::parse($first_day[$i])->format('M');          //название месяца рус

            $data_month[$i][0] = $count_month[$i];
            $data_month[$i][1] = $name_month[$i];
        }
        $jas_all = Jas::all();
        $count_jas = count($jas_all);   //общее кол-во событий

        return view('web.opo_main', compact('jas', 'ver_opo', 'elems_opo', 'all_opo', 'oper_safety', 'id', 'ready', 'failure_free',
           'data_rtn_noncheck', 'data_rtn_check', 'count_jas', 'data_month'));
    }

    public function new($id_opo)
    {
        $ver_opo =  Ref_opo::find($id_opo);
        $all_opo = Ref_opo::all(); //Сыслка на все ОПО для панели
        return view('operational.new', compact('all_opo', 'ver_opo', 'id_opo'));
    }

    public function new_ready($id_opo)
    {
        $ver_opo =  Ref_opo::find($id_opo);
        $all_opo = Ref_opo::all(); //Сыслка на все ОПО для панели
        return view('ready.new', compact('all_opo', 'ver_opo', 'id_opo'));
    }

    public function new_failure_free($id_opo)
    {
        $ver_opo =  Ref_opo::find($id_opo);
        $all_opo = Ref_opo::all(); //Сыслка на все ОПО для панели
        return view('failure_free.new', compact('all_opo', 'ver_opo', 'id_opo'));
    }

////       ********************** Операции с расчетом показателя безопасности ОПО*****************************
//    public function operational_edit($id, $id_row){
//        $data = Operational_safety::find($id_row);
//        $ver_opo =  Ref_opo::find($id);
//        $all_opo = Ref_opo::all(); //Сыслка на все ОПО для панели
//        return view('operational_safety.edit',compact('data', 'ver_opo', 'all_opo'));
//    }
//    public function operational_update(Request $request){
//        $input = $request->all();
//        $id_row = $request->id;
//        $data = Operational_safety::find($id_row);
//        $data->update($input);
//        dd ($request);
//        return redirect()->route('/opo/{id}/main')
//            ->with('success','User updated successfully');
//        $ver_opo =  Ref_opo::find($id);
//        $all_opo = Ref_opo::all(); //Сыслка на все ОПО для панели
//        return view('operational_safety.edit',compact('data', 'ver_opo', 'all_opo'));
//    }


    ///************************* Формирование данных для мини графика **********************************
    public static function view_ip_last ($id)
    {

        $opos = Ref_opo::find($id);
        foreach ($opos->opo_to_calc30 as $ip)
        {
            $data1[] = array (strtotime($ip->date.'+ 4 hours')*1000, $ip['ip_opo']);
        }
        $str = 'неудача';
        if(isset($data1)){

            return str_replace('"', '', json_encode(array_reverse($data1, false)));
        }
        else
            return  $str;//->first()->date;
    }
    ///************************* Формирование данных интегрального показателя **********************************
    public static function view_ip_last_test ($id, $data)    //текущее
    {
        $calcs = Calc_ip_opo_i::orderByDesc('id')->where('from_opo', '=', $id)->where('date', '<=', $data)->take(60)->get();
        foreach ($calcs as $ip) {
            $data1[] = array(strtotime($ip->date.'+ 4 hours') * 1000, $ip['ip_opo']);
        }
        $str = 'неудача';
        if(isset($data1)){
            return str_replace('"', '', json_encode(array_reverse($data1, false)));
        }
        else
            return  $str;
    }
    public static function view_ip_last_test_hour ($id, $data) //часовое
    {
        $opos = Ref_opo::find($id);
        $calcs = Calc_ip_opo_hour::select('ip_opo_'.$id, 'date')->where('date', '<=', $data)->orderByDesc('id')->take(30)->get();
        foreach ($calcs as $ip) {
            $data1[] = array(strtotime($ip->date.'+ 4 hours') * 1000, $ip['ip_opo_'.$id]);
        }
        $str = 'неудача';
        if(isset($data1)){
            return str_replace('"', '', json_encode(array_reverse($data1, false)));
        }
        else
            return  $str;
    }
    public static function view_ip_last_test_day ($id, $data)    //суточное
    {
        $opos = Ref_opo::find($id);
        $calcs = Calc_ip_opo_day::select('ip_opo_'.$id, 'date')->where('date', '<=', $data)->orderByDesc('id')->take(30)->get();
        foreach ($calcs as $ip) {
            $data1[] = array(strtotime($ip->date.'+ 4 hours') * 1000, $ip['ip_opo_'.$id]);
        }
        $str = 'неудача';
        if(isset($data1)){
            return str_replace('"', '', json_encode(array_reverse($data1, false)));
        }
        else
            return  $str;
    }
    ///************************* Формирование данных для мини графика прогнозного показателя **********************************
    public static function view_ip_pro_last ($id)
    {
        $opos = Ref_opo::find($id);
        foreach ($opos->opo_to_calc_opo_pro as $ip)
        {
            $data1[] = array (strtotime($ip->date.'+ 4 hours')*1000, $ip['pro_ip_opo']);
        }
        $str = 'неудача';
        if(isset($data1)){
            return str_replace('"', '', json_encode(array_reverse($data1, false)));
        }
        else
            return  $str;//->first()->date;

    }
    ///************************* Формирование данных для графика прогнозного показателя **********************************
    public static function view_ip_pro_date ($id, $data)   //часовой
    {
        $opos = Calc_pro_ip_opoi::orderByDesc('id')->where('from_opo', '=', $id)->where('forecast_period', '=', '0 years 0 mons 0 days 1 hours 0 mins 0.00 secs')
            ->where('date', '<=', $data)->take(30)->get();
        foreach ($opos as $ip)
        {
            $data1[] = array (strtotime($ip->date.'+ 4 hours')*1000, $ip['pro_ip_opo']);
        }
        $str = 'неудача';
        if(isset($data1)){

            return str_replace('"', '', json_encode(array_reverse($data1, false)));
        }
        else
            return  $str;//->first()->date;

    }
    public static function view_ip_pro_date_day ($id, $data)   //суточный
    {
        $opos = Calc_pro_ip_opoi::orderByDesc('id')->where('from_opo', '=', $id)->where('forecast_period', '=', '0 years 0 mons 1 days 0 hours 0 mins 0.00 secs')
            ->where('date', '<=', $data)->take(30)->get();
        foreach ($opos as $ip)
        {
            $data1[] = array (strtotime($ip->date.'+ 4 hours')*1000, $ip['pro_ip_opo']);
        }
        $str = 'неудача';
        if(isset($data1)){

            return str_replace('"', '', json_encode(array_reverse($data1, false)));
        }
        else
            return  $str;//->first()->date;

    }
    public static function view_ip_pro_date_month ($id, $data)   //месячный
    {
        $opos = Calc_pro_ip_opoi::orderByDesc('id')->where('from_opo', '=', $id)->where('forecast_period', '=', '0 years 1 mons 0 days 0 hours 0 mins 0.00 secs')
            ->where('date', '<=', $data)->take(30)->get();
        foreach ($opos as $ip)
        {
            $data1[] = array (strtotime($ip->date.'+ 4 hours')*1000, $ip['pro_ip_opo']);
        }
        $str = 'неудача';
        if(isset($data1)){

            return str_replace('"', '', json_encode(array_reverse($data1, false)));
        }
        else
            return  $str;//->first()->date;

    }
    ///************************* Формирование IP_OPO текущего для конкрентного ОПО **********************************
    public static function view_ip_opo ($id)
    {
       // $opos = Ref_opo::find($id);

        return  Ref_opo::find($id)->opo_to_calc1->first()->ip_opo;
    }

    //************************ Отображение ситуационного плана ОПО ФС *************************
    public function Show_FS_Plan()

    {


    }

    public function view_plan($id){
        return view('web.maps.plan', ['id' => $id]);
    }

    public function get_jas1($count){
        if ($count==0){
            $jas = Jas::where('check', 'false')->get();
        }
        else{
            $jas=Jas::orderBy('id','DESC')->take($count)->get();
        }

        $data[]=array();

        $i=0;
        foreach ($jas as $value){
            $data[$i]['date']=date('d-m-Y H:i:s', strtotime($value->data));
            $data[$i]['level']=$value->level;
            $data[$i]['descOPO']=$value->jas_to_opo->descOPO;
            $data[$i]['nameObj']=$value->jas_to_elem->nameObj;
            $data[$i]['status']=$value->status;
            $data[$i]['name']=$value->name;
            $data[$i]['check']=$value->check;
            $data[$i]['id']=$value->id;

            $i+=1;
        }

        return json_encode($data, JSON_UNESCAPED_UNICODE);
    }

    public function get_sum()
    {
        return json_encode(Jas::count());
    }

    public function set_check(Request $request){

        $post = $request->all();
        $res=Jas::updated_check($post['id']);
        if ($res) {
         return json_encode(array('result'=>'true'));
        }
        else{
            $res=array('result'=>'false', 'error'=>$res);
            return json_encode($res);
        }

        //return json_encode(array('result'=>'true'));

    }

    //******************** Справочник ОПО ****************************

    public function show_OPO_all()
    {
        $data = Ref_opo::orderBy('idOPO')->get();
        AdminController::log_record('Открыл справочник ОПО');//пишем в журнал
        return view('web.docs.matrix.infoOPO.index', compact('data'));
    }
    public function edit_OPO($idOPO)
    {
        $data = Ref_opo::find($idOPO);
        AdminController::log_record('Открыл для редактирования запись в справочнике ОПО');//пишем в журнал
        return view('web.docs.matrix.infoOPO.edit',compact('data'));
    }
    public function update_OPO(Request $request, $idOPO)
    {
        $input = $request->all();
        $data = Ref_opo::find($idOPO);
        $data['login'] = Auth::user()->name;
        $data->update($input);
        AdminController::log_record('Сохранил после редактирования запись в справочнике ОПО');//пишем в журнал
        return redirect("/docs/infoOPO");
    }
    public function show_OPO($idOPO)
    {
        $data = Ref_opo::find($idOPO);
        AdminController::log_record('Открыл для просмотра запись о ОПО');//пишем в журнал
        return view('web.docs.matrix.infoOPO.show',compact('data'));
    }
    public function create_OPO()
    {
        return view('web.docs.matrix.infoOPO.create');
    }
    public function store_OPO(Request $request)
    {
        $input = $request->all();
        $input['guid'] = sprintf('%04X%04X-%04X-%04X-%04X-%04X%04X%04X', mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(16384, 20479), mt_rand(32768, 49151), mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535));
        $input['login'] = Auth::user()->name;
        $predRTN = Ref_opo::create($input);
        AdminController::log_record('Создал запись в справочнике ОПО');//пишем в журнал
        return redirect('/docs/infoOPO');
    }
    public function delete_OPO($idOPO)
    {
        Ref_opo::find($idOPO)->delete();
        AdminController::log_record('Удалил запись в справочнике ОПО');//пишем в журнал
        return redirect('/docs/infoOPO');
    }

}
