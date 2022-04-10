<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Type_obj extends Model
{
    protected $table = 'public.type_obj';
    public $primaryKey = 'type_id';
    protected $fillable = [
        'id', 'type_obj_name',
    ];


}
