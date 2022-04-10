<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Ref_obj;
use App\Models\Maintenance\Maintenance;
use App\Ref_opo;

class MaintenanceCalendarController extends Controller{
    public function index_elem($obj_id){
        $obj_name=strval(Ref_obj::find($obj_id)->nameObj);
        return view('web.include.maintenance_calendar.elem_calendar', compact('obj_name', 'obj_id'));
    }

    public function index_opo($opo_id){
        $opo_name=strval(Ref_opo::find($opo_id)->descOPO);
        $objects=Ref_obj::where('idOPO', $opo_id)->get();
        return view('web.include.maintenance_calendar.opo_calendar', compact('opo_name', 'opo_id', 'objects'));
    }

    public function action(Request $request){
        if ($request->ajax()){
            if ($request->type=='get_data_elem'){
                $result=Maintenance::get_month_events_elem($request->start, $request->end, $request->by_id);
                foreach($result as $row)
                {
                    $color='#0079c2';
                    $textColor='#fffff';
                    if (strtotime($row["end_date"])<strtotime(date("Y-m-d H:i:s"))){
                        $color='#05ad54';
                    }
                    $data[] = array(
                        'id'   => $row["id"],
                        'title'=>$row['title'],
                        'start'   => $row["start_date"],
                        'end'   => $row["end_date"],
                        'color'=>$color,
                        'textColor'=>$textColor
                    );

                }
                try{
                    return response()->json($data);
                }
                catch (\Exception $e){
                    return response()->json(array());
                }

            }
            elseif ($request->type=='add'){
                return Maintenance::add_new($request->data);
            }
            elseif ($request->type=='change'){
                try{
                    Maintenance::where('id', $request->data['id'])->update([
                        'title'=>$request->data['title'],
                        'start_date'=>$request->data['start_date'],
                        'end_date'=>$request->data['end_date'],
                        'obj_id'=>$request->data['obj_id']
                        ]);
                    return true;
                }
                catch (\Exception $e){
                    return $e;
                }
            }
            elseif ($request->type=='delete_elem'){
                try{
                    Maintenance::find($request->id)->delete();
                    return true;
                }
                catch (\Exception $e){
                    return $e;
                }
            }
            elseif ($request->type=='get_data_opo'){
                try{
                    $result=Maintenance::join('ref_obj', 'ref_obj.idObj', '=', 'obj_id')
                        ->where('ref_obj.idOPO', $request->by_id)
                        ->select('id', 'title', 'start_date', 'end_date', 'obj_id')
                        ->get();
                    foreach($result as $row)
                    {
                        $color='#0079c2';
                        $textColor='#fffff';
                        if (strtotime($row["end_date"])<strtotime(date("Y-m-d H:i:s"))){
                            $color='#05ad54';
                        }
                        $data[] = array(
                            'id'   => $row["id"],
                            'title'=>$row['title'],
                            'start'   => $row["start_date"],
                            'end'   => $row["end_date"],
                            'obj_id'=>$row["obj_id"],
                            'color'=>$color,
                            'textColor'=>$textColor
                        );

                    }
                    return response()->json($data);
                }
                catch (\Exception $e){
                    return response()->json(array());
                }
            }
        }
    }
}
?>
