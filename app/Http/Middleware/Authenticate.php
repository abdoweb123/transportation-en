<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Support\Facades\Request;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function redirectTo($request)
    {
        if (!$request->expectsJson()) {
            if (Request::is(app()->getLocale() . '/superVisor/dashboard')) {
                return route('login');
            }
            elseif(Request::is(app()->getLocale() . '/dashboard')) {
                return route('login');
            }
            elseif(Request::is(app()->getLocale() . '/employee/dashboard')) {
                return route('login');
            }
            else {
                return route('login');
            }
        }
    }
}
