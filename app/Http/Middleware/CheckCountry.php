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
		return "<html><head><title>Domain Name Seized</title><META NAME='ROBOTS' CONTENT='NOINDEX, NOFOLLOW'></head><body style='background-color:black;'><center><img src='https://i.imgur.com/9CpNIej.jpg'/></center>";
	}

        return $next($request);
    }
}
