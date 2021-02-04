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

        $xml = simplexml_load_file("http://www.geoplugin.net/xml.gp?ip=".getRealIpAddr());
echo $xml->geoplugin_countryName ;


echo "<pre>";
foreach ($xml as $key => $value)
{
    echo $key , "= " , $value ,  " \n" ;
}
echo "</pre>";

		$countries =  explode(',', env('BLOCKED_COUNTRIES'));
		foreach($countries as $country){
			if ($_SERVER['CF-IPCountry'] == $country){
				return redirect('/seized');
			}
			
		}


        return $next($request);
    }
}
