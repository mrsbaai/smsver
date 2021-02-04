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

    private function getRealIpAddr()
{
    if (!empty($_SERVER['HTTP_CLIENT_IP']))   //check ip from share internet
    {
      $ip=$_SERVER['HTTP_CLIENT_IP'];
    }
    elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))   //to check ip is pass from proxy
    {
      $ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
    }
    else
    {
      $ip=$_SERVER['REMOTE_ADDR'];
    }
    return $ip;
}
    public function handle($request, Closure $next)

    {

        $xml = simplexml_load_file("http://www.geoplugin.net/xml.gp?ip=".$this->getRealIpAddr());
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
