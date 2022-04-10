<?php

namespace App\Http\Controllers;

use App\Models\Glossary\Table_abbrev;
use App\Models\Glossary\Table_desc_PB;
use App\Models\Glossary\Table_termin;
use Illuminate\Http\Request;
use App\Models\Glossary\Table_class;

class GlossaryControllers extends Controller
{
    public function showHelp ()
//       ********************** Вывести схему на страницу Конкретного ОПО по ИД *****************************
    {

        $jas = OpoController::view_jas_15();     // Жас всех ОПО 15 записей
        $events = Table_class::orderBy('id')->get();
        $desc_pbs = Table_desc_PB::orderBy('id')->get();
        $termins = Table_termin::orderBy('id')->get();
        $abbrevs = Table_abbrev::orderBy('id')->get();
        return view('web.docs.glossary.index', compact('jas', 'events' , 'desc_pbs', 'termins', 'abbrevs'));

    }
}
