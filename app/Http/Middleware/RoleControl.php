<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Auth;

class RoleControl
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, $role)
    {

        /** 1 administrator */
        /** 2 merchant */
        /** 3 merchant_report_user */

        $_roles             =   explode('|', $role);

        $user_role          =   Auth::user()->role;
        $segment            =   request()->segment(1);

        if(in_array($user_role, $_roles)){ /** Ulaşmaya çalıştığı sayfa route tarafından rol olarak tanımlandıysa erişebilir. */

            return $next($request);

        }else{

            return redirect()->back();


        }

    }
}
