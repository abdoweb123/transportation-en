<?php

namespace App\Http\Controllers;

use App\Http\Requests\RouteRequest;
use App\Models\Route;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RouteController extends Controller
{


    /*** get all offices ***/
    public function index()
    {
        $routes = Route::whereAdminId(Auth::guard('admin')->id());
        $comapnies=Company::select('id','name')->get();
        if (request('company_id')) {
            $routes=$routes->where('company_id',request('company_id'));
        }
        $routes=$routes->paginate();
        $request_company_id=request('company_id');
        return view('pages.Routes.index', compact('routes','comapnies','request_company_id'));
    }
    public function switch_status(Request $request)
    {
        $data=Route::find($request->id);

        if ($data->active == 0) {
            $data->active = 1;
        }else{
            $data->active = 0;
        }
        $data->save();
        return response()->json('تم التعديل بنجاح');
    }


    /*** create an office ***/
    public function store(RouteRequest $request)
    {
        try {
            $route = new Route();
            $route->name = $request->name;
            $route->admin_id = auth('admin')->id();
            $route->company_id=$request->company_id;
            $route->description=$request->description;
            $route->active = 1;
            $route->save();
            return redirect()->back()->with('alert-success','Data is saved successfully');
        }
        catch (\Exception $exception)
        {
            return redirect()->back()->withErrors(['error' => $exception->getMessage()]);
        }
    }



    /*** update the office ***/
    public function update(RouteRequest $request)
    {
        try {
            $route = Route::findOrFail($request->id);
            $route->name = $request->name;
            $route->admin_id = auth('admin')->id();
            $route->active = $request->active;
            $route->company_id=$request->company_id;
            $route->description=$request->description;
            $route->update();
            return redirect()->back()->with('alert-success','Data is updated successfully');
        }
        catch (\Exception $exception)
        {
            return redirect()->back()->withErrors(['error' => $exception->getMessage()]);
        }
    }



    /*** delete the office ***/
    public function destroy(Request $request)
    {
        $route = Route::findOrFail($request->id)->delete();
        return redirect()->back()->with('alert-success','Data is deleted successfully');
    }

} //end of class
