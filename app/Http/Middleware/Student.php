<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class Student
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        // dd(auth()->user()->role);

        // if (auth()->user()->role == config('constant.SUPERADMIN')) {
        //     return route('dashboard');
        // }


        // if (auth()->user()->role == config('constant.SCHOOLADMIN')) {
        //     return route('dashboard');
        // }

        // dd(auth()->user()->role);

        if (auth()->user()->role != config('constant.STUDENT')) {
            return redirect()->route('dashboard');
        }
        return $next($request);
    }
}
