<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class SetLocale
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
        if($request->session()->has('locale')){
            $locale = session('locale');
        }
        else{
            $locale = 'en';
        }

        if ($request->locale == 'en') { 
            $locale = 'en';
        } else if ($request->locale == 'bg') { 
            $locale = 'bg';
        }

        $request->session()->put('locale', $locale);

        //set the derived locale
        App::setLocale($locale);

        return $next($request);
    }
}
