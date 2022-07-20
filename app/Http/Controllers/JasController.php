<?php

namespace App\Http\Controllers;

use App\Jas;
use App\Ref_opo;
use Illuminate\Http\Request;

class JasController extends Controller
{
    public function showJas()
    {
        $data_to_jas = \App\Models\Jas::orderbyDesc('id')->where('auto_generate', '=', true)->get();
        return view('web.jas.index', compact('data_to_jas'));
    }

    public function jas_in_top_table()
    {
        $data_to_jas = \App\Models\Jas::orderbyDesc('id')->where('auto_generate', '=', true)->take(20)->get();
        return $data_to_jas;
    }
}
