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
            return redirect('/payment')->cookie('plan', $plan, '60');
        }

        if ($request->cookie('plan')){
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

            return view('payment')
                ->with('plan',$plan_str)
                ->with('usd',$usd)
                ->with('btc',$btc)
                ->with('address',$address)
                ->with('numbers',$numbers);
        }else{
            return view('plan');
        }

    }


    private function getBicoinAddress(){
        $arrX = array(
            "1K6THAhE17LkbCecLat34ncD3JKwKjjMK5",
            "1Fv3PYg2ezjoFKJTPbAmD2htruX8vx4QkM",
            "1G3LaSAC7cWHAU2dU5UwnyVeEpmzuXc7rD",
            "1EMieMUHsWgyeS39puArw1QqrJaU2xmCgf",
            "1CEp9EfhhvE9qQUVqJtS1KxqPXnTmgf7Ps",
            "19RC6JZfNhQboV7zQ1WsXuB6PvRRD6sZD3",
            "1BnZC7He6knXqD5M5bdXY2sLnTGmNjYv4n");
        $randIndex = array_rand($arrX);
        return $arrX[$randIndex];

    }
}
