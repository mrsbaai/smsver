<?php

namespace App\Http\Controllers;


use Symfony\Component\HttpFoundation\Cookie;
use Illuminate\Support\Facades\Auth;
use DB;
use User;

use Illuminate\Support\Facades\Response;
use SMTPValidateEmail\Validator as SmtpEmailValidator;

class pagesController extends Controller
{
	
	    public function validateTest(){


        $sender = 'example@hotmail.com';
        $emails = array(
            'ylfo2ik3ti9fgij4zmtw@hotmail.com',
            'blooddity@hotmail.com'

        );

        $validator = new SmtpEmailValidator($emails, $sender);
        $results   = $validator->validate();
        $log = $validator->getLog();
        return Response::json(array($results, $log));



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
    
	
    public function home(){

        if (Auth::check()){
            $ip = $this->getIp();
            User::where('email', "=", Auth::email())->update(['ip' => $ip]);
            return redirect()->intended('payment');
        }
        $messageController = new messagesController();
        $messages = $messageController->getMessages(null);
        $lastMessage =  $messages[0]['id'];
        return view('home')->with('messages', $messages)->with('lastMessage', $lastMessage);

    }

    public function pricing(){
        if (Auth::check()){return redirect()->intended('plan');}
        return view('pricing');
    }



    public function plan(){
        return view('plan');
    }
    public function dashboard(){
        return view('setup');
    }

    public function logout(){

        if (Auth::check()){
            Auth::logout();
        }
        return redirect('/');
    }

    public function forgot(){
        if (Auth::check()){return redirect()->intended('payment');}
        return view('forgot');
    }
    public function contact(){
        if (Auth::check()){return redirect()->intended('payment');}
        return view('contact');
    }
    public function register($plan = null){
        if (Auth::check()){return redirect()->intended('payment');}
        if ($plan !== null){
            return redirect('/register')->cookie('plan', $plan, '60');
        }

        return view('register');
    }

        public function terms(){
        return view('terms');
    }
    public function privacy(){
        return view('privacy');
    }
    public function login(){
        if (Auth::check()){return redirect()->intended('payment');}
        return view('login');
    }
    public function api(){
        if (Auth::check()){return redirect()->intended('payment');}
        return view('api');
    }
}
