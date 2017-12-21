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
            "18y3oh6uU9YuZ2y8DW1VzK3V97K5TjCP7Z",
            "17LziDYF3oKstJhEjdVGLps4boq5u6sSuM",
            "1GgC7qGjofxDgYujuxQBjVM6LrCPqC8Ra1",
            "1DX3qnTDxw9Zf2HTLRbgHFsSH4TaMixjhz",
            "146mkK2unQcAH1UUDrTsNFGZo16PihKG2W",
            "19nFn5CJNLzp9m1yQVV7hckeDQHhjtNedM",
            "1LNJ3SqjiGbFyPaz6Jkd6n9wENRWAtPqbQ",
            "17uKptdQgxvLduedEBSRC3KTdLhjQJCmyi",
            "1PvLKKXNHxniKJZfmANcr9nsjmDaQMqnmY",
            "1CNG1QnpmSeNHmCE7XY5t8Tv81tpGMAFMt",
            "1M2Veqs3UaqqwD85DLcmuCmXjjsuGHekV3",
            "1GziVGE4bm85WD3bNjARMQa7WRvm4s5uaE",
            "14KjZCU1EUByeyfm1tsPe7UyS6Tg9fKBQ1",
            "1BUZNbGeiJYmcVFHXrTXjDgDUnBH1523w2",
            "17uXj5Cf3z3TfzvviYbeoueRDfSDtnwd6f",
            "13TJwbWXY6dQLAdVpoGupMtkRo6xdD2a4f",
            "1CU9t28ei29rtVGacoJkfcX4e2WVhZ3anN",
            "17PtJspsGPpnJc3gynAg2Jsy5vicCQxiKs",
            "1JfzCu2MpKUfDyeTurpJ4YdDGQw2oahLd5",
            "1K2DNGQAdn4RfZGVNjqLKXgptzKwdbxwp2",
            "1F2sz2ir8AEuBgA9SADbL5fzovPXQmqcUn",
            "1K6THAhE17LkbCecLat34ncD3JKwKjjMK5",
            "1D1N6uHQ14XYdLFRUGAf4VCDhrLkvauRxk",
            "1K72TnSWf7aRAZ56V1Ks7VqjESVAtJDH9Y",
            "13LezPv8h7txc2oxZTDk5cJeZRGwRnyi38",
            "1G3LaSAC7cWHAU2dU5UwnyVeEpmzuXc7rD",
            "1MFRkBqLhCzAmk8Ri4jwBBx1umR117yFTf",
            "1CcFdVaLLv6qBAta6xjEri3CS26yuoB3Xr",
            "158ZoyBG6TcHkuzSwy4nwnwSdrSFTd3FQB",
            "1AKih6Ar9RFVSAMKucS6Ku1BFNA9XN3gS9",
            "14MDvA6nYY9J6PaUEBHEjoQjiN5JwduwdB",
            "1LMFUzpqL32JVQJVpVuiVrc8A6MpuN8LGu",
            "1CfjrrAUsfKrcgFJvnNSfoadvD8T1epP1R",
            "1KMHBpjCjXGJBtNDha4rQ64UH16NENy563",
            "1N61JybhagTgvkhFZm6BGUb1v7oUtZy25s",
            "17jG6sZGmXSTs4T4Naz3bv8Bdxqz4awPmS",
            "113GkYPgtfcKYPoGnpCZ8GoHrHEFC5ExNv",
            "1C7YexpF8ig2ZhR9ZMtJFWXofim28U7pLJ",
            "16QBxRnTiiVfhE8jHAefAg6K318PgFcSBE",
            "1LgBhm5ekk1R9wzMuuhJcnEU9TtR4J75uG",
            "18TuwT925n8sBNWsoCMKZLDWKnRRfL1tZD",
            "1HCxzAh9cW3viYgASPsebu5tRbwmWWwLXs",
            "1KNVYDVJEJqNrXPHox6Mj7iZXVULF7p2F6",
            "1DJHeTCqpYj3ib9jPETiz7tFCcXCRJtaA9",
            "17gNUve4eCBqX7uE3NeN1CRtb2rxFX1t8T",
            "16uU7JLMqoHX2EtwMh7j5nZu9hKdUCDExS",
            "12gbWsYVRzgZpE8tdUHq3iDBc3gBWpTp9T",
            "1AvgwxY4HnRMJmNRp8H6FBM2YApuXjM7kj",
            "1KSGNd7RQLZ43eS4fmVJ9Y5MP26zt3Gu18",
            "14XEsn47vPY7k31qbP94Vm3qUJG1dFabzq",
            "1KMEaCnbGrsDHjzL4v89SwkeF3j5rA89RQ",
            "1DxpBZd7EVuGpGaUnBXyd1WweXBiHke4LW",
            "1L1Jju9T6wPD6TBivoq71WMKw5EeogfDET",
            "1HGvsvUK7336PeTgenRmgyVJdcMvq7dAxS",
            "1C87XfZ6dVgVvbbEP6QwAR2jNai96fpLwv",
            "166SdBcBvZtHSddBP9HHpX1Co5SVL54FZS",
            "14FgVk3u5mjpKPYFhMagXd3D3CJvQTrmzv",
            "1A9eYfJLCq6tAA5618As7SWvM4WD7bzfDA",
            "1Asdo52Z3Vzf1zSZGo6qQ96gSS4Z1JgUva",
            "1454bJLRQZABtNYJq5UeVxcNzLa3mnod2z",
            "1JwuypPykmW3hjNQHksazF613EuEddL9D8",
            "18fVkiWgLxJjYDeLsas6XjG5Z3F1MdRAM8",
            "1H4b9HsUaytu85Qiskv34paqwDiuZJYpVg",
            "15t15VNZoNg8udU4YjqhUKHkFxHiVxpbCF",
            "1Ec6jjh7dh7ZJyC41snG3uzMZ4ne5vLnWH",
            "1GUeW8mrdA9KirhBwKYiZYJ66DtFNUVn5b",
            "1FHCCL48kLHfF8YZy61Uwwkps4fmGfU3eX",
            "1BvYjjLA7HbCbLW4nUYgAM697Jqk7TKcWZ",
            "1PYMDVBziHR9viiaLCSE2BkPKksyiMbjb2",
            "1LtSZwr4UVpRAe2W3tYukpVs8W9EAuAbgi",
            "1QCXk6hCn18KGe5WHEgw88Y2zo6VhG8BWR",
            "1EJSaLbM4F5zetg4dKMnNkY7A41jB3iErv",
            "17fM969t1dD51u1ews7eCveSnQ7m4nn9eP",
            "128eEu5YH5fPvoTgQ1FPdi8evLvBxYkBb2",
            "1HhNR5JCRq1JjRwYLLHcyvAtpMK5tmdvwZ",
            "1945Wdaeg8JFrFmizwbF972ZtpQczuhwiX",
            "1BnZC7He6knXqD5M5bdXY2sLnTGmNjYv4n",
            "1EMieMUHsWgyeS39puArw1QqrJaU2xmCgf",
            "1GTfMKAsXPkCYzwibndPrQwNyc11PMcT6U",
            "15NchXT9M7VxqeM5kBhXmHhCVF5c8Wo5kW",
            "1KNkgrNTfa4ZejYjpXnWLkDa9MtPNJeZiT",
            "1MrH5BeDfUqScuVjBLdLcwXHMeTj77PHnm",
            "1FfPKSuEc9e64aLAfTGTyTpkeTGZ7zCmut",
            "1Q3TNQa5XKgTHJQXQmGWzc26LnvEucfkAd",
            "181nb63mkhHPDnkdMGFQi3hNM4q5MhFGqa",
            "1LsaM3pAt3er7jEBsvXhqwZFSJU9yNwJi1",
            "1Pb1KZpKVr3dXhwpwcDXpdersWuGugiUxD",
            "14fap1idmGnosbDbxboQLZfXckGU9dnrB4",
            "12hcZPj6RfT4ecMP8QtXXcPTuXgP2KohWN",
            "1NLah1T1vcmes8tTYezeUirkaCU1xT3DFf",
            "1FPitNxZnVpYZYiDLRFkkbB4dbPmqTrK9w",
            "15Sem4iTF1i3VBiNseBQ6JThi4Y5L2wDNk",
            "1KYj2AZS4Q6N15Lvx1CB2y6zbxRZ44tpg7",
            "1PDN59KsKuNQF9kz4uudkFbAKgUvZkry8F",
            "1A6gDUetHEAsdAFYpQZWtaBmLb3c5xpkiz",
            "1EQxZxmTUzVyzrPFYGLHxq1HDpzicM36sk",
            "1Lx114XELpoYFUcEwqfT93PTHDtFLdRGUs",
            "1EBzHtMKS9CEefZchCkk8zqEDxzukZ1rFs",
            "1LEnD6t3KrDvBF2nTRgFtMRDunU4JMJQvT",
            "1PjHCCy5FFRLvg4J3NNKZKivd59aHqBKWb",
            "1NDBMzGHDr48hyqFVU5D3wfhgj9nSjTDni",
            "12XRXjfMcr7noh7AyQdALcF6rWPsE13n8Z",
            "1JRtuKFSzd3DKt2STz863BbmGiZKJTGLKt",
            "1LtyMtgMhyURm7iw8QpMoNWjGeBx2ewX75",
            "1PSwCdHQNndXF1gMyJkR6RUYzQEM3CiSdx",
            "1PWvgxcTWbgbRoLHxt17hsgjhzF98iScfb",
            "16M3AVh2dy8Kh1mek5UkSvG6EmffrkjUyw",
            "17RM3p9L9yE9f6T5tQ5jm255ZzK9cSP3vu",
            "12DGA1hhemnxoXuhxX3SAXoG7APujGzDkE",
            "1Bn2X3Y4d9BM965p1XjkS4McZ6qAqD8dN3",
            "1Fv3PYg2ezjoFKJTPbAmD2htruX8vx4QkM",
            "12nqWzZZsQv5zkTzhgpb7xD21mJZxEvMXH",
            "1MBh9EM5HPfsW6Kvq7r7q9GGN7xFD5re8n",
            "1CEp9EfhhvE9qQUVqJtS1KxqPXnTmgf7Ps",
            "1JBMqUr8RkLJGS2FJyVQeePK5vbG39BpJV",
            "1MFxBQUfFQeWAj7ddRQEvFqjuFBwcqwXUH",
            "16i6dkVbNqkPEfTbvM1Z5HfRpzZDFqPbpi",
            "1Fuj5esXrkg493Lxi95x6EQ3AAJ77kgnXn",
            "1MRd3R3ogQPcTGmYxvGE9VkPsTAbcFFr9c",
            "1JjqoW4JkzasXimcfR3zJ7gxp9aCt99Jtw",
            "183zp6Nq3XxLrF8Q7ZqbDjeR7GLCADsjDg",
            "13kEN6abq3XDiWwvXkcPabULRARpDBwAbP",
            "1PP5AGzZfCm7NLDWVMVUxGEeSK5X4Ht47v",
            "1JUyShXdBrUE7HoX3fqruaWd4oePDjkqTL",
            "1FUNbpfNmdrjycTfr1JYAGWicxtYXciwsV",
            "16KVZwdMDEZfrvzW8eqrDCNXqZjdff4xn1",
            "1Fvq6rhhaenDGfGmJJnmcLBbkCXJM2Hdx7",
            "1Eejzt1jA7idDypN4ShsGRZZ3usELD8uty",
            "19RC6JZfNhQboV7zQ1WsXuB6PvRRD6sZD3",
            "1FfYe7gtDYbxnFsKwKDt4pq8sFWSBZPTev",
            "1PpHTqu8rZwYDEw2EWLyzQtYGMYUyepGA9",
            "1MG9ZVkrEUD2uCaDXqWRR9FdqypqZuJpiJ",
            "18LxqL8Lj3P8mxd9W3f8fgGxEegCWVeogE",
            "1PWncLhn3ksk7SV97mZiwkw7joRWbUDbnc",
            "1ECT447bySXJy2CHnCBMqPPX4PPfFXeM3h",
            "1HfgbTb3w3BSBsgdk2CL3h9BJhaaYSnoCV",
            "1J7QY9yscLE9WbbmitkMcja4pdEjv7aQxs",
            "17rPKvQztZrkkSWfaciX8fUALW1Axe3A5Q"
        );
        $randIndex = array_rand($arrX);
        return $arrX[$randIndex];

    }
}
