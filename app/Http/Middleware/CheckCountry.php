<?php

namespace App\Http\Middleware;

use Closure;


class CheckCountry
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)

    {
		$countries =  explode(',', env('BLOCKED_COUNTRIES'));
		foreach($countries as $country){
			if ($_SERVER['HTTP_CF_IPCOUNTRY'] == $country){
				return $_SERVER['HTTP_CF_IPCOUNTRY'];
			}
			
		}


        return $next($request);
    }
}
