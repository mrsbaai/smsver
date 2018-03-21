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
        Mail::to('abdelilah.sbaai@gmail.com')->send(new start());
    }

    public function UsdToBtc($usd){
        $CoinDesk = file_get_contents('http://api.coindesk.com/v1/bpi/currentprice.json');
        $CoinDesk = json_decode($CoinDesk, true);
        $usd_btc = ($CoinDesk != "" ? $CoinDesk['bpi']['USD']['rate_float'] : $btcven_json_decode['BTC']['USD']);
        $btc = $usd/$usd_btc;
        $btc = number_format($btc, 6);
        return $btc;
    }


    public function create()
    {

        $password = Input::get('reg_password');
        $email =  Input::get('reg_email');

        try{
            $user = new User();
            $user->email = $email;
            $user->password = bcrypt($password);
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
    public function contact(){
        $email = Input::get('lg_email');
        $subject = Input::get('lg_subject');
        $content = Input::get('lg_message');




        try{

            $subject = "(SMS-Verification Contact From) " . $subject;
            $to = 'support@sms-verification.net';
            Mail::send('mails.contact', ['content' => $content], function ($message) use($subject,$email, $to){
                $message->from($email);
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

    public function showChooseType(){
        return view('type');
    }
    public function redirectToBitcoin(Request $request){
        $address = $this->getBicoinAddress();

        switch ($request->cookie('plan')) {
            case 1:
                $plan_str = "Starter";
                $usd = "300";
                $btc = $this->UsdToBtc($usd);
                $numbers = "200";
                break;
            case 2:
                $plan_str = "Business";
                $usd = "500";
                $btc = $this->UsdToBtc($usd);
                $numbers = "500";
                break;
            case 3:
                $plan_str = "Extended";
                $usd = "700";
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

    public function redirectToPayPal(Request $request){


        switch ($request->cookie('plan')) {
            case 1:
                $plan_str = "Starter";
                $usd = "300";
                $numbers = "200";
                break;
            case 2:
                $plan_str = "Business";
                $usd = "500";
                $numbers = "500";
                break;
            case 3:
                $plan_str = "Extended";
                $usd = "700";
                $numbers = "1000";
                break;
        }

        $cmd = '_xclick';
        $business = $this->GetPayPal();
        $item_name = $numbers . " Numbers For 1 Year (" . $plan_str . " Plan)";
        $currency_code = 'USD';
        $custom = "SMS-Verification";
        $amount = $usd;
        $return = 'https://sms-verification.net/thankyou';
        $notify_url = 'http://receive-sms.com/ipn/smsver';
        $cancel_return = 'https://sms-verification.net';

        $properties = array(
            "cmd"=>$cmd,
            "business"=>$business,
            "item_name"=>$item_name,
            "currency_code"=>$currency_code,
            "custom"=>$custom,
            "amount"=>$amount,
            "return"=>$return,
            "notify_url"=>$notify_url,
            "cancel_return"=>$cancel_return
        );
        $url = "https://www.paypal.com/cgi-bin/webscr";
        return redirect()->away($url . "?" . http_build_query($properties));
    }

    private function GetPayPal(){
        $arrX = array(
            "X4FGEEWR2ZAZJ",
        );
        $randIndex = array_rand($arrX);
        return $arrX[$randIndex];
    }
    private function getBicoinAddress(){
        $arrX = array(
            "34i6FGTA8d6FuAzyJaT2ZYRdYRapiCoh1x",
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
