<?php

namespace App\Http\Controllers;

use App\Models\Reports\ActualDeclarations;
use App\Models\Logs;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use DateTime;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        AdminController::log_record('Открыл документарный блок  ');//пишем в журнал

        return view('web.docs.reports.report_main');
    }
    public function actual_declarations(Request $request)
    {
        AdminController::log_record('Открыл реестр актуальных декларация ПБ  ');//пишем в журнал
        $data_to_table = ActualDeclarations::orderByDesc('id')->get();
        return view('web.docs.reports.report_actual_declarations', compact('data_to_table'));
    }
}
