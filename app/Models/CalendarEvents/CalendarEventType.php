<?php
namespace App\Models\CalendarEvents;

use Illuminate\Database\Eloquent\Model;

class CalendarEventType extends Model{
    protected $table='apk_opo.calendar_event_types';

    public function get_event_type($id){
        return $this->find($id)->get();
    }

    public static function get_id_by_name($name){
        return CalendarEventType::where('name', '=', $name)->get()->id;
    }

    protected $fillable = [
        'name',
    ];
}

?>
