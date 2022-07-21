<?php

namespace App\Http\Controllers;

use App\Jas;
use App\Ref_opo;
use Illuminate\Http\Request;
use phpDocumentor\Reflection\Types\True_;

class JasController extends Controller
{
    public function showJas()
    {
        $data_to_jas = \App\Models\Jas::orderbyDesc('id')->where('auto_generate', '=', true)->get();
        AdminController::log_record('Открыл журнал аварийных событий  ');//пишем в журнал
        return view('web.jas.index', compact('data_to_jas'));
    }

    public function jas_in_top_table()
    {
        $data_to_jas = \App\Models\Jas::orderbyDesc('id')->where('auto_generate', '=', true)->take(20)->get();
        return $data_to_jas;
    }
    public function check_new_JAS()
    {
        $data_to_jas = \App\Models\Jas::orderbyDesc('id')->where('auto_generate', '=', true)->where('check', '=', false)->get();
        if (count($data_to_jas) != 0){
            return $data_to_jas;
        } else{
            return false;
        }
    }
    public function jas_commit($id)
    {
        try {
            $check_sobitie = \App\Models\Jas::find($id)->update(['check'=>true]);
            $date = date('Y-m-d H:i:s', strtotime(\App\Models\Jas::find($id)->first()->date));
            AdminController::log_record("Квитировал событие от $date ");//пишем в журнал
            return true;
        } catch (\Throwable $e){
            return $e;
        }
    }


}
