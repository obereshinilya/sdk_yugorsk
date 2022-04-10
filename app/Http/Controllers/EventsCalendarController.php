<?php
namespace App\Http\Controllers;

use App\Models\CalendarEvents\CalendarEventType;
use App\Models\CalendarEvents\CalendarEvent;
use App\User;
use Illuminate\Http\Request;
use App\Ref_opo;


class EventsCalendarController extends  Controller {
    public function index($opo_id){
        $types=CalendarEventType::all();
        $users=User::all();
        $opo_name=strval(Ref_opo::find($opo_id)->descOPO);
        return view('web.include.eventsCalendar.calendar', compact('opo_id', 'types', 'users', 'opo_name'));
    }


    public function action(Request $request){
        if ($request->ajax()){
            if ($request->type=='get_data'){
                $result=CalendarEvent::get_month_events($request->start, $request->end, $request->opo);
                #$result=CalendarEvent::find(23);
                foreach($result as $row)
                {

                    if ((strtotime($row["end_datetime"])<strtotime(date("Y-m-d H:i:s"))) and ($row->status==2 or $row->status==1)){
                        $row['status']=4;
                        $row->update([
                           'status'=>4,
                        ]);
                    }

                    $color='#33c3ec';
                    $textColor='#000000';
                    if ($row->status==1){
                        $color='#69c9e7';
                    }
                    else if ($row->status==2){
                        $color='#bbad16';
                    }
                    else if ($row->status==3){
                        $color='#20bc15';
                    }
                    else if ($row->status==4){
                        $color='#c71425';
                    }
                    $data[] = array(
                        'id'   => $row["id"],
                        'title'   => $row["title"],
                        'start'   => $row["start_datetime"],
                        'end'   => $row["end_datetime"],
                        'creator_user'=> $row->crt_usr->name,
                        'creator_user_id'=>$row->creator_user_id,
                        'dest_user_id'=>$row->dest_user_id,
                        'dest_user'=>$row->dst_usr->name,
                        'event_type'=>$row->str_event_type->name,
                        'event_type_id'=>$row->type,
                        'description'=>$row->description,
                        'status'=>$row->str_event_status->status,
                        'status_id'=>$row->status,
                        'color'=>$color,
                        'textColor'=>$textColor
                    );

                }
                return response()->json($data);
            }
            else if ($request->type=='add'){
                //return response()->json($request->data);
                return CalendarEvent::add_new_event($request->data);
            }
            else if ($request->type=='change_status'){
                //return response()->json($request);
                try{
                    $event=CalendarEvent::find($request->id);
                    if ($event->status==1){
                        $event->update([
                            'status'=>2
                        ]);
                    }
                    else if ($event->status==2){
                        $event->update([
                            'status'=>3
                        ]);
                    }
                    return true;
                }
                catch (\Exception $e){
                    return $e;
                }

            }
            else if ($request->type=='delete'){
                try{
                    CalendarEvent::find($request->id)->delete();
                    return true;
                }
                catch (\Exception $e){
                    return $e;
                }
            }
            else if($request->type=='change'){
//                return $request->event_id;
                try{
                    CalendarEvent::where('id', $request->event_id)->update(['dest_user_id'=>$request->dest_user_id,
                        'type'=>$request->event_type,
                        'title'=>$request->title,
                        'start_date'=>$request->start_datetime,
                        'end_date'=>$request->end_datetime,
                        'description'=>$request->description]);
                    return true;
                }
                catch (\Exception $e){
                    return $e;
                }
            }
        }
    }

    public function test(){
        $users=User::find(1);
        $result=CalendarEvent::find(23);
        return json_encode($result);
        #return view('web.include.eventsCalendar.test', compact('users'));
    }


}

?>
