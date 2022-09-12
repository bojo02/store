<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Auth;

class AdminMiddleware
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
        $isAdmin = false;

        if(Auth::user())
        {
            foreach(Auth::user()->userRole as $userRole){
                if($userRole->role->slug == 'administrator'){
                    $isAdmin = true;
                }
            }
        }
        if($isAdmin == false){
            return redirect()->back()->with('alert_danger', 'Нямаш права за да достъпиш тази страница!');
        }
        

        return $next($request);
    }
}
