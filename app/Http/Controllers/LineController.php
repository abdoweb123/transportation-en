<?php

namespace App\Http\Controllers;

use App\Http\Requests\LinesRequest;
use App\Models\Degree;
use App\Models\Line;
use App\Models\Station;
use App\Models\TripData;
use App\Models\TripStation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LineController extends Controller
{

    /*** createLinesOfTrip function  ***/
    public function getLinesOfTrip($tripData_id)
    {


        $data['lines'] = Line::join('trip_stations','trip_stations.id','=','lines.stationFrom_id')
            ->where('lines.tripData_id', $tripData_id)->orderBy('trip_stations.rank')->select('lines.*')->paginate(25);


        $data['tripData'] = TripData::find($tripData_id)->first();

        return view('pages.TripData.Lines.index', compact('data'))->with('alert-success','تم تسجيل البيانات بنجاح');
    }


     /*** createLinesOfTrip function  ***/
    public function createLinesOfTrip(Request $request)
    {

        $tripData_id = $request->tripData_id;

        foreach ($request->tripStations as $tripStation)
        {
             $stations = TripStation::where('id',$tripStation); //7
             $rank =  $stations->select('rank')->pluck('rank'); //15
             $ranks[] = $rank;
        }

        sort($ranks);


        foreach ($ranks as $row)
        {
          foreach ($row as $k){
              $newRanks[] = $k;
          }
        }


        // 0 , 1 , 2                                                      2,6    2,10   6,10
        for ($i=0; $i<count($newRanks); $i++){   //  15 , 20 , 25  ==>>  15,20  15,25  20,25

            $ranks1 = $newRanks;

            $x = $i;
            for ($x++; $x<count($newRanks); $x++)
            {

                // $getStationFrom_id
                $rankStationFrom = $ranks1[$i];
                $stationFrom_id = TripStation::where('tripData_id',$tripData_id)->where('rank',$rankStationFrom)->pluck('id');
                $getStationFrom_id = str_replace(array('[',']'), '',$stationFrom_id);

                // $getStationFrom_id type
                $stationFromType = TripStation::where('id',$getStationFrom_id)->pluck('type');
                $getStationFromType = str_replace(array('[',']'), '',$stationFromType);



                // $getStationTo_id
                $rankStationTo = $newRanks[$x];
                $stationTo_id = TripStation::where('tripData_id',$tripData_id)->where('rank',$rankStationTo)->pluck('id');
                $getStationTo_id = str_replace(array('[',']'), '',$stationTo_id);

                // $getStationTo_id type
                $stationToType = TripStation::where('id',$getStationTo_id)->pluck('type');
                $getStationToType = str_replace(array('[',']'), '',$stationToType);



                if ( DB::table('lines')->where('stationFrom_id',$getStationFrom_id)->where('stationTo_id',$stationTo_id)->pluck('id') == '[]')
                {
                    // Not created
                                                    // حتي لا يكون هناك خط بين المحطة ونفسها
                    if ($getStationFromType != 2 && $getStationFrom_id != $getStationTo_id)
                    {
                        $StationFromWithType_id = $getStationFrom_id;


                        Line::create([
                            'tripData_id'=>$tripData_id,
                            'admin_id'=>auth('admin')->id(),
                            'stationFrom_id'=>$StationFromWithType_id,
                            'stationTo_id'=>$getStationTo_id,
                            'active'=>1,
                        ]);

                    }

                }

                if ($getStationFromType == 2 && $getStationFrom_id != $getStationTo_id)
                {
                      Line::where('stationFrom_id',$getStationFrom_id)->forceDelete();
                }

            }
        }

        return redirect()->route('getLinesOfTrip',$tripData_id);
    }



    /*** store function  ***/
    public function store(Request $request)
    {

        for ($i=0; $i<count($request->id); $i++)
        {
           $id = $request->id[$i];
           $priceGo = $request->priceGo[$i];
           $priceBack = $request->priceBack[$i];
           $priceForeignerGo = $request->priceForeignerGo[$i];
           $priceForeignerBack = $request->priceForeignerBack[$i];
           $active = $request->active[$i];
           $cancelFee = $request->cancelFee[$i];
           $editFee = $request->editFee[$i];

           $line = Line::find($id);

           $line->update([
               'priceGo'=>$priceGo,
               'priceBack'=>$priceBack,
               'priceForeignerGo'=>$priceForeignerGo,
               'priceForeignerBack'=>$priceForeignerBack,
               'active'=>$active,
               'cancelFee'=>$cancelFee,
               'editFee'=>$editFee,
           ]);

        }
        return redirect()->back()->with('alert-success','تم تحديث البيانات بنجاح');


    }



    /*** update function  ***/
//    public function update(Request $request)
//    {
//        return $request;
//        $line = Line::findOrFail($request->id);

//        $line->update([
//            'active'=>$request->active,
//            'priceGo'=>$request->priceGo,
//            'priceBack'=>$request->priceBack,
//            'priceForeignerGo'=>$request->priceForeignerGo,
//            'priceForeignerBack'=>$request->priceForeignerBack,
//            'cancelFee'=>$request->cancelFee,
//            'editFee'=>$request->editFee,
//        ]);

//        return redirect()->back()->with('alert-success','تم تحديث البيانات بنجاح');
//    }



    /*** destroy function  ***/
    public function destroy(Request $request)
    {
        $line = Line::findOrFail($request->id)->delete();
        return redirect()->back()->with('alert-success','تم حذف البيانات بنجاح');
    }

} //end of class
