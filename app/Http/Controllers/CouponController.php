<?php

namespace App\Http\Controllers;

use App\Http\Requests\CouponRequest;
use App\Models\Coupon;
use App\Models\CouponTrip;
use App\Models\TripData;
use Illuminate\Http\Request;

class CouponController extends Controller
{

    /*** get all coupons ***/
    public function index()
    {
        $coupons = Coupon::latest()->paginate(10);
        $trips = TripData::select('id','name')->get();
        return view('pages.Coupons.index', compact('coupons','trips'));
    }



    /*** store coupon ***/
    public function store(CouponRequest $request)
    {

        if ($request->allTrips== null && $request->trips == null)
        {
            return redirect()->back()->with('alert-danger','برجاء إدخال اسم الرحلة');
        }


        if ($request->percent == '0')   // %
        {

            if ($request->amount > 100){
                return redirect()->back()->with('alert-danger','يجب ألا يتعدي الخصم 100 %');
            }
             else{
                 Coupon::create([
                     'code' =>$request->code,
                     'amount' =>$request->amount,
                     'percent' =>0,
                     'max_amount' =>$request->max_amount,
                     'startDate' =>$request->startDate,
                     'endDate' =>$request->endDate,
                     'max_users' =>$request->max_users,
                     'used_by' =>$request->max_users,
                     'used_count' =>0,
                     'active' =>1,
                     'notes' =>$request->notes,
                     'admin_id' =>auth('admin')->id(),
                 ]);


                 // create couponTrips
                 $latestCoupon = Coupon::latest()->first()->id;

                 if ($request->allTrips == null)   // اذن هو اختار عدد معين من الرحلات
                 {

                     foreach ($request->trips as $trip_id)
                     {
                         CouponTrip::create([
                            'coupon_id'=>$latestCoupon,
                            'tripData_id'=>$trip_id,
                            'admin_id' =>auth('admin')->id(),
                         ]);
                     }
                 }
                  else{

                      $trips = TripData::pluck('id');

                      foreach ($trips as $trip_id)
                      {
                          CouponTrip::create([
                              'coupon_id'=>$latestCoupon,
                              'tripData_id'=>$trip_id,
                              'admin_id' =>auth('admin')->id(),
                          ]);
                      }

                  }

             }
        }
         else{                  // جنيه
             Coupon::create([
                 'code' =>$request->code,
                 'amount' =>$request->amount,
                 'percent' =>1,
                 'max_amount' =>$request->max_amount,
                 'startDate' =>$request->startDate,
                 'endDate' =>$request->endDate,
                 'max_users' =>$request->max_users,
                 'used_by' =>$request->max_users,
                 'used_count' =>0,
                 'active' =>1,
                 'notes' =>$request->notes,
                 'admin_id' =>auth('admin')->id(),
             ]);
         }

        // create couponTrips
        $latestCoupon = Coupon::latest()->first()->id;

        if ($request->allTrips == null)   // اذن هو اختار عدد معين من الرحلات
        {

            foreach ($request->trips as $trip_id)
            {
                CouponTrip::create([
                    'coupon_id'=>$latestCoupon,
                    'tripData_id'=>$trip_id,
                    'admin_id' =>auth('admin')->id(),
                ]);
            }
        }
        else{

            $trips = TripData::pluck('id');

            foreach ($trips as $trip_id)
            {
                CouponTrip::create([
                    'coupon_id'=>$latestCoupon,
                    'tripData_id'=>$trip_id,
                    'admin_id' =>auth('admin')->id(),
                ]);
            }

        }

         return redirect()->back()->with('alert-success','تم حفظ البيانات بنجاح');
    }



    /*** update coupon ***/
    public function update(CouponRequest $request, Coupon $coupon)
    {

//        return $coupon->id;

        if ($request->percent == '0')   // %
        {

            if ($request->amount > 100){
                return redirect()->back()->with('alert-danger','يجب ألا يتعدي الخصم 100 %');
            }
            else{
                $coupon->update([
                    'code' =>$request->code,
                    'amount' =>$request->amount,
                    'percent' =>0,
                    'max_amount' =>$request->max_amount,
                    'startDate' =>$request->startDate,
                    'endDate' =>$request->endDate,
                    'max_users' =>$request->max_users,
                    'notes' =>$request->notes,
                    'admin_id' =>auth('admin')->id(),
                ]);



                // update couponTrips
                if ($request->allTrips == null)   // اذن هو اختار عدد معين من الرحلات
                {
                    foreach ($request->trips as $trip_id)
                    {
                        $trip = CouponTrip::where('tripData_id',$trip_id)->where('coupon_id',$coupon->id)->first();

                        if ($trip == true)
                        {
                            $trip->update([
                                'coupon_id'=>$coupon->id,
                                'tripData_id'=>$trip_id,
                                'admin_id' =>auth('admin')->id(),
                            ]);
                        }
                        else{
                            CouponTrip::create([
                                'coupon_id'=>$coupon->id,
                                'tripData_id'=>$trip_id,
                                'admin_id' =>auth('admin')->id(),
                            ]);
                        }


                    }
                }
                else{

                    $trips = TripData::pluck('id');

                    foreach ($trips as $trip_id)
                    {
                        $trip = CouponTrip::find($trip_id)->where('coupon_id',$coupon->id);

                        if ($trip)
                        {
                            $trip->update([
                                'coupon_id'=>$coupon->id,
                                'tripData_id'=>$trip_id,
                                'admin_id' =>auth('admin')->id(),
                            ]);
                        }
                        else{
                            CouponTrip::create([
                                'coupon_id'=>$coupon->id,
                                'tripData_id'=>$trip_id,
                                'admin_id' =>auth('admin')->id(),
                            ]);
                        }
                    }
                }
            }


        }
        else{                  // جنيه
            $coupon->update([
                'code' =>$request->code,
                'amount' =>$request->amount,
                'percent' =>1,
                'max_amount' =>null,
                'startDate' =>$request->startDate,
                'endDate' =>$request->endDate,
                'max_users' =>$request->max_users,
                'notes' =>$request->notes,
                'admin_id' =>auth('admin')->id(),
            ]);


            // update couponTrips
            if ($request->allTrips == null)   // اذن هو اختار عدد معين من الرحلات
            {
                foreach ($request->trips as $trip_id)
                {
                    $trip = CouponTrip::where('coupon_id',$coupon->id)->find($trip_id);

                    if ($trip == true)
                    {
                        $trip->update([
                            'coupon_id'=>$coupon->id,
                            'tripData_id'=>$trip_id,
                            'admin_id' =>auth('admin')->id(),
                        ]);
                    }
                    else{
                        CouponTrip::create([
                            'coupon_id'=>$coupon->id,
                            'tripData_id'=>$trip_id,
                            'admin_id' =>auth('admin')->id(),
                        ]);
                    }


                }
            }
            else{

                $trips = CouponTrip::select('id')->get();

                foreach ($trips as $trip_id)
                {
                    $trip = CouponTrip::find($trip_id)->where('coupon_id',$coupon->id);

                    if ($trip)
                    {
                        $trip->update([
                            'coupon_id'=>$coupon->id,
                            'tripData_id'=>$trip_id,
                            'admin_id' =>auth('admin')->id(),
                        ]);
                    }
                    else{
                        CouponTrip::create([
                            'coupon_id'=>$coupon->id,
                            'tripData_id'=>$trip_id,
                            'admin_id' =>auth('admin')->id(),
                        ]);
                    }
                }
            }


        }



        return redirect()->back()->with('alert-info','تم تحديث البيانات بنجاح');
    }




    /*** delete coupons ***/
    public function destroy(Coupon $coupon)
    {
        $coupon->delete();
        return redirect()->back()->with('alert-success','تم حذف البيانات بنجاح');
    }


} //end of class
