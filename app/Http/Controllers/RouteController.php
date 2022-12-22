<?php

namespace App\Http\Controllers;

use App\Http\Requests\RouteRequest;
use App\Models\Route;
use Illuminate\Http\Request;

class RouteController extends Controller
{


    /*** get all offices ***/
    public function index()
    {
        $routes = Route::all();
        return view('pages.Routes.index', compact('routes'));
    }



    /*** create an office ***/
    public function store(RouteRequest $request)
    {
        try {
            $route = new Route();
            $route->name = $request->name;
            $route->admin_id = auth('admin')->id();
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
