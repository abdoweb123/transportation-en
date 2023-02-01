<?php

namespace App\Http\Controllers;

use App\Http\Requests\VendorRequest;
use App\Models\Vendor;
use App\Models\StaticTable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class VendorController extends Controller
{

    /*** index function  ***/
    public function index()
    {
        $vendors = Vendor::whereAdminId(Auth::guard('admin')->id())->latest()->paginate(10);
        $vendor_types=StaticTable::whereType('vendor_type')->select('id','name')->get();
        return view('pages.Vendors.index', compact('vendors','vendor_types'));
    }



    /*** store function  ***/
    public function store(VendorRequest $request)
    {
        Vendor::create([
            'name'=>$request->name,
            'phone'=>$request->phone,
            'email'=>$request->email,
            'description'=>$request->description,
            'vendor_type_id'=>$request->vendor_type_id,
            'registration_number'=>$request->registration_number,
            'national_id'=>$request->national_id,
            'taxes_number'=>$request->taxes_number,
            'active'=>1,
            'admin_id'=>auth('admin')->id(),
        ]);

        return redirect()->back()->with('alert-success','Data is saved successfully');
    }



    /*** update function  ***/
    public function update(VendorRequest $request, Vendor $vendor)
    {
        $vendor->update([
            'name'=>$request->name,
            'phone'=>$request->phone,
            'email'=>$request->email,
            'description'=>$request->description,
            'vendor_type_id'=>$request->vendor_type_id,
            'registration_number'=>$request->registration_number,
            'national_id'=>$request->national_id,
            'taxes_number'=>$request->taxes_number,
            'active'=>$request->active,
            'admin_id'=>auth('admin')->id(),
        ]);

        return redirect()->back()->with('alert-success','Data is updated successfully');
    }



    /*** destroy function  ***/
    public function destroy(Vendor $vendor)
    {
        $vendor->delete();
        return redirect()->back()->with('alert-success','Data iss deleted successfully');
    }



} //end of class
