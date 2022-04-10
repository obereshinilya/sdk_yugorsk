<?php

namespace App;

use Carbon\Carbon;
use http\Env\Request;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Ref_opo extends Model
{
    protected $table = 'ref_opo';
    public $timestamps = false;
    public $primaryKey = 'idOPO';
    protected $fillable = [
        'uuidopo', 'idopo', 'from_type_opo', 'descopo', 'regnumopo', 'datereg', 'classhazard', 'fulldescopo', 'datemodif', 'usermodif'
    ];


}
