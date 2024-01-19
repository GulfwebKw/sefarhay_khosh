<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class localization
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Check header request and determine localizaton
        if($request->hasHeader('X-localization')){
            $local = ($request->hasHeader('X-localization') and in_array( $request->header('X-localization') , ['fa' , 'en'])) ? $request->header('X-localization') : 'en';
            app()->setLocale($local);
        }
        if(session()->has('locale') and in_array(session()->get('locale') , ['fa' , 'en']))
        {
            app()->setlocale(session()->get('locale'));
        }
        return $next($request);
    }
}
