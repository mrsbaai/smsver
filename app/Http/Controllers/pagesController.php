<?php

namespace App\Http\Controllers;


use Symfony\Component\HttpFoundation\Cookie;
use Illuminate\Support\Facades\Auth;
use DB;


class pagesController extends Controller
{
    public function home(){

        if (Auth::check()){return redirect()->intended('payment');}
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
