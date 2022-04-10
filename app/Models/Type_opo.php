<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Type_opo extends Model
{
    protected $table = 'public.type_opo';
    public $primaryKey = 'type_id';
    protected $fillable = [
        'id', 'desc_opo_type', 'full_desc_opo_type'
    ];


}
