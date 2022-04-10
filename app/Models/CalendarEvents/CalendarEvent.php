<?php
namespace App\Models\CalendarEvents;

use Illuminate\Database\Eloquent\Model;
use App\Models\CalendarEvents\CalendarEventType;
use App\Models\CalendarEvents\CalendarEventStatus;

class CalendarEvent extends Model {
    protected $table='apk_opo.calendar_events';

    //protected $dateFormat = 'd.m.Y';
    public $timestamps = false;
    protected $fillable = [
        'creator_user_id', 'dest_user_id','type', 'title', 'opo_id', 'start_datetime', 'end_datetime', 'description', 'status'
    ];


    public static function get_month_events($start, $end, $opo_id){
        return CalendarEvent::where([['start_datetime', '>=', $start], ['end_datetime', '<=', $end], ['opo_id', '=', $opo_id]])->get();
    }

    public static function add_new_event($data){
        try{
            CalendarEvent::create([
                'creator_user_id' => $data['creator_user_id'],
                'dest_user_id'=>$data['dest_user_id'],
                'type'=>$data['event_type'],
                'title'=>$data['title'],
                'opo_id'=>$data['opo_id'],
                'start_datetime'=>$data['start_datetime'],
                'end_datetime'=>$data['end_datetime'],
                'description'=>$data['description']]);
            return true;
        }
        catch (\Exception $e) {
            return $e;
        }

    }

    public function crt_usr(){
        return $this->belongsTo('App\User', 'creator_user_id', 'id');
    }

    public function dst_usr(){
        return $this->belongsTo('App\User', 'dest_user_id', 'id');
    }

    public function str_event_type(){
        return $this->belongsTo('App\Models\CalendarEvents\CalendarEventType', 'type', 'id');
    }

    public function str_event_status(){
        return $this->belongsTo('App\Models\CalendarEvents\CalendarEventStatus', 'status', 'id');
    }
}

?>
