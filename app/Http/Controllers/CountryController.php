<?php

namespace App\Http\Controllers;

use App\Http\Requests\CountryRequest;
use App\Models\Country;
use Illuminate\Http\Request;

class CountryController extends Controller
{

    /*** index function ***/
    public function index()
    {
        $countries = Country::latest()->paginate(10);
        return view('countries.index', compact('countries'));
    }



    /*** store function ***/
    public function store(CountryRequest $request)
    {
        $country = new Country();
        $country->name = ['en' => $request->name_en, 'ar' => $request->name_ar];
        $country->active = 1;
        $country->code = $request->code;
        if( $image = $request->file('image'))
        {
            $path = 'assets/images/';
            $photo = time() . rand(1,20000). uniqid() . '.' . $image->getClientOriginalExtension();
            $image->move($path,$photo);
            $country->image= "$photo";
        }
        $country->save();

        return redirect()->route('countries.index')->with('alert-success','تم تسجيل البيانات بنجاح');
    }



    /*** update function ***/
    public function update(CountryRequest $request, Country $country)
    {
        $country->name = ['en' => $request->name_en, 'ar' => $request->name_ar];
        $country->active = $request->active;
        $country->code = $request->code;
        if( $image = $request->file('image'))
        {
            $image_path = 'assets/images/'.$country->image;
            if (file_exists($image_path))
            {
                @unlink($image_path);
            }

            $path = 'assets/images/';
            $photo = time() . rand(1,20000). uniqid() . '.' . $image->getClientOriginalExtension();
            $image->move($path,$photo);
            $country->image= "$photo";
        }
        $country->update();

        return redirect()->route('countries.index')->with('alert-info','تم تعديل البيانات بنجاح');
    }



    /*** destroy function ***/
    public function destroy(Country $country)
    {
        $country->delete();
        return redirect()->route('countries.index')->with('alert-success','تم نقل البيانات إلى سلة المهملات');
    }


} //end of class
