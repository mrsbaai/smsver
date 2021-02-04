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
			if ($_SERVER['CF-IPCountry'] == $country){
				return redirect('/seized');
			}
			
		}


        return $next($request);
    }
}
