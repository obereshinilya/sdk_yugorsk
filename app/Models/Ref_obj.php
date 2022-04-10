<?php

namespace App\Models;

use http\Env\Request;
use Illuminate\Database\Eloquent\Model;

class Ref_obj extends Model
{
    protected $table = 'public.ref_obj';
    public $timestamps = false;
    public $primaryKey = 'idobj';

    protected $fillable = [
        'idobj', 'uuidobj', 'from_ref_opo', 'descobj', 'inuse', 'fulldescobj', 'from_type_obj',
    ];



}
