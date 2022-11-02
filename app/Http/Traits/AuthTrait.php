<?php

namespace App\Http\Traits;

use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Auth;

trait AuthTrait
{
    public function chekGuard($request){

        if($request->type == 'superVisor'){
            $guardName= 'superVisor';
        }
        elseif ($request->type == 'admin'){
            $guardName= 'admin';
        }
        elseif ($request->type == 'employee'){
            $guardName= 'employee';
        }
        else{
            $guardName= 'web';
        }
        return $guardName;
    }

    public function redirect($request){

//        $user = Auth::user();

        if($request->type == 'superVisor'){
            return redirect()->intended(RouteServiceProvider::SUPERVISOR);
        }
        elseif ($request->type == 'admin'){
            return redirect()->intended(RouteServiceProvider::ADMIN);
        }
        elseif ($request->type == 'employee'){
            return redirect()->intended(RouteServiceProvider::EMPLOYEE);
        }
        else{
            return redirect()->intended(RouteServiceProvider::HOME);
        }
    }
}
