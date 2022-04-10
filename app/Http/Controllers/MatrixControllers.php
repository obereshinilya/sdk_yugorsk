<?php

namespace App\Http\Controllers;

use App\Http\Livewire\Rtn\ActionPlan;
use App\Models\CalendarEvents\CalendarEventType;
use App\Models\Ref_obj;
use App\Models\Ref_oto;
use App\Models\Rtn;
use App\Models\Status_obj;
use App\Models\Type_obj;
use App\Models\Wells_type;
use App\Ref_opo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MatrixControllers extends Controller
{
    //******************* Обзор справочника возможных событий ****************************
    public function showEvent()
    {
        $jas = OpoController::view_jas_15();     // Жас всех ОПО 15 записей
        return view('web.docs.matrix.events.index', compact('jas'));
    }
    //******************* Обзор коэффициентов для расчетов ****************************
    public function showkoef()
    {
        $jas = OpoController::view_jas_15();     // Жас всех ОПО 15 записей
        return view('web.docs.koef.index', compact('jas'));
    }
    //******************* Обзор типов событий календаря ****************************
    public function show_calendar_event()
    {
        $data_ok = CalendarEventType::orderBy('id')->get();
        return view('web.docs.matrix.calendar_events.index', compact('data_ok'));
    }
    //******************** Обзор Регламентных значений ****************************
    public function Showregl()
    {
        $jas = OpoController::view_jas_15();     // Жас всех ОПО 15 записей
        return view('web.docs.reglament.index', compact('jas'));

    }
    //******************** Обзор отчета РТН ****************************
    public function Showrtn()
    {
        $jas = OpoController::view_jas_15();     // Жас всех ОПО 15 записей
        return view('web.docs.rtn.index', compact('jas'));

    }
    //******************** Обзор сценариев ****************************
    public function Showmatrix()
    {
        $jas = OpoController::view_jas_15();     // Жас всех ОПО 15 записей
        return view('web.docs.matrix.scenar.index', compact('jas'));

    }

    //******************** Обзор предписаний РТН ****************************
    public function show_RTN_all()
    {
        AdminController::log_record('Открыл список предписаний РТН');//пишем в журнал
        $data = Rtn::orderByDesc('id')->get();
        return view('web.docs.matrix.predRTN.index', compact('data'));
    }
    public function edit_RTN($id)
    {
        $data = Rtn::find($id);
        $data_all = Ref_opo::all();
        AdminController::log_record('Открыл для редактирования предписание РТН');//пишем в журнал
        return view('web.docs.matrix.predRTN.edit',compact('data', 'data_all'));
    }
    public function update_RTN(Request $request, $id)
    {

        $input = $request->all();
        $data = Rtn::find($id);
        $data->update($input);
        AdminController::log_record('Сохранил после редактирования предписание РТН');//пишем в журнал
        return redirect("/docs/predRTN");
    }
    public function show_RTN($id)
    {
        $data = Rtn::find($id);
        $data_all = Ref_opo::all();
        AdminController::log_record('Открыл для просмотра предписание РТН');//пишем в журнал

        return view('web.docs.matrix.predRTN.show',compact('data', 'data_all'));
    }
    public function create_RTN()
    {
        $data_all = Ref_opo::all();
        return view('web.docs.matrix.predRTN.create', compact('data_all'));
    }
    public function store_RTN(Request $request)
    {
        $input = $request->all();
        $predRTN = Rtn::create($input);
        AdminController::log_record('Создал запись предписания РТН');//пишем в журнал
        return redirect('/docs/predRTN');
    }
    public function delete_RTN($id)
    {
        Rtn::find($id)->delete();
        AdminController::log_record('Удалил запись предписания РТН');//пишем в журнал
        return redirect('/docs/predRTN');
    }

    public function change_param(Request $request){
        if ($request->type=='rtn'){
            return ActionPlan::update_param($request->id, $request->param, $request->value);
        };
    }

//    public function change_param(Request $request){
//        if ($request->type=='rtn'){
//            return ActionPlan::update_param($request->id, $request->param, $request->value);
//        };
//    }

}
