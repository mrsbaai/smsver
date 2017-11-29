<?php

namespace App\Http\Controllers;

use App\Message;

use Carbon\Carbon;

use Illuminate\Support\Facades\Log;


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




    public function logMessage($from = null,$to = null,$text = null){
        Log::info("me inside");

        if ($from <> null and $to <> null and $text <> null){
            $text = urldecode($text);

            $time = Carbon::now();
            $message = new message();
            $message->message = $text;
            $message->sender = $from;
            $message->receiver = $to;
            $message->date = $time;
            $message->save();
            
        }else{
            return "Nice Try ;)";
        }

        return "success!";
    }



}
