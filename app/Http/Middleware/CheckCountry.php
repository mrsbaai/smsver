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
	if ($_SERVER['HTTP_CF_IPCOUNTRY'] == "TH" or $_SERVER['HTTP_CF_IPCOUNTRY'] == "MA"){
		return redirect('/seeized');
	}

        return $next($request);
    }
}
