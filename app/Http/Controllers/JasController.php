<?php

namespace App\Http\Controllers;

use App\Jas;
use App\Ref_opo;
use Illuminate\Http\Request;

class JasController extends Controller
{
    public function showJas()
    {
        $all_jas = count(Jas::orderByDesc('data')->get());
        $jas = Jas::sortable()->paginate(20);
        $opo = Ref_opo::orderBy('idOPO')->get();
        $id = 1;
        return view('web.jas.index', compact('all_jas', 'jas', 'opo', 'id'));
    }
}
