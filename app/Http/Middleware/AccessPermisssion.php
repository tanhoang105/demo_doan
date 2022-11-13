<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AccessPermisssion
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next ,$role)
    {
        // dd($role);
      

        if(Auth::user()->hasAnyRole([$role])){

            return $next($request);
        }else  {
            abort(423, 'Xin lỗi, bạn không có quyền truy cập !');
            // return view('error')->with('msg' , 'Bạn không có quyền truy cập ');
        }
    }
}
