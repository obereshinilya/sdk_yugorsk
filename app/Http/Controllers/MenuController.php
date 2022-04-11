<?php

namespace App\Http\Controllers;

use App\Models\Calc_mku_pipe_cond;
use App\Models\Logs_safety;
use App\Ref_opo;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use DB;

class MenuController extends Controller
{
   public function view_menu ()
   {
    $v_menu = Calc_mku_pipe_cond::orderByDesc('id')->select('obj_tech_cond')->first();
    if ($v_menu == 'operable'){
        $v_menu = 'good';
        $rezhim = 'Штатный режим';
    } elseif ($v_menu == 'workable'){
        $v_menu = 'bad';
        $rezhim = 'Средний риск';
    } else{
        $v_menu = 'critical';
        $rezhim = 'Высокий риск';
    }
    $data_opos = [1=>'Test'];
   AdminController::log_record('Открыл ситуационную карту');//пишем в журнал

   return view('web.gda', ['name' => $v_menu, 'rezhim'=>$rezhim, 'data_opos'=>$data_opos]);
   }
}
