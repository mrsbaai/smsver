<?php

namespace App\Http\Controllers;

use App\Message;
use Illuminate\Http\Request;

use App\Libraries\Session;

use Carbon\Carbon;

class messagesController extends Controller
{
    public function getMessages(){

        $messages = Message::orderBy('date', 'desc')->simplePaginate(10);

        foreach($messages as $message){
            $message['sender'] = $this->hideLast($message['sender']);
        }
        return $messages;

    }

    private function hideLast($str){
        if (strlen($str) > 6 && is_numeric($str)){
            $len=strlen($str);
            $val=substr($str,0,($len-4));
            $val=$val . "XXXX";
            return $val;
        }
    }

    public function newMessages($id){
        $message = message::where('id',$id)->first();
        $lastDate = $message['date'];

        if ($lastDate == null){
            return;
        }


        $messages = message::where('is_private',false)->where('date' , '>', $lastDate)->get()->sortByDesc('date');

        foreach($messages as $message){
            $message['sender'] = $this->hideLast($message['sender']);
        }

        return response()->json($messages);


    }


    public function tropo(){



        $from = null;
        $to = null;
        $text = null;

        $session = new Session();

        $text = $session->getInitialText();
        $from = $session->getFrom();
        $to = $session->getTo();

        if ($from <> null and $to <> null and $text <> null){
            $this->logMessage($from, $to, $text);
        }else{
            return "";
        }

        return "success!";
    }

    public function logMessage($from, $to, $text){

        $time = Carbon::now();
        $message = new message();
        $message->message = $text;
        $message->sender = $from;
        $message->receiver = $to;
        $message->date = $time;
        $message->save();

        $this->sendCallback($from,$to,$text);

        return "";


    }


}
