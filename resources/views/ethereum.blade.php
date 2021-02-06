
@extends('layouts.app')





@section('head')



    <link rel="stylesheet" media="screen" href="../fonts/font-awesome/font-awesome.min.css" />
    <title>[{{env('APP_NAME')}}] Payment</title>

@stop

@section('content')

    <div class="container  col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center" style="padding-bottom:20px;">
        <h1>Pay With Ethereum</h1>
    </div>


    <div class="container width-fix col-xs-12 col-sm-12 col-md-12 col-lg-12" >

            <div class="row align-items-center" >
                <div class="container col-xs-12 col-sm-12 col-md-12 col-lg-10" >
                    <a href="/plan" type="button" class="btn btn-default btn-lg">
                        <span class="fa fa-chevron-left" aria-hidden="true"></span> Different Plan
                    </a>
                    <br/><br/>
                    <div class="jumbotron" style="padding:20px; background-color: #ced4d8; color:black;" >
                        <p>Please transfer the exact amount of <strong>{{$eth}} ETH</strong> to the ETH address shown on this page in one transaction.</p>
                        <div class="row align-items-end" >
                            <div class="col-4 text-left" >
                                {!!QrCode::size(250)->generate('ethereum:'. $address . '?amount=' . $eth)!!}
                            </div>
                            <div class="col text-right" style="font-size: 120%">
                                <span style="font-size: 150%">
                                    <strong>Plan: {{$plan}}</strong><br/>
                                    ({{$numbers}} Numbers/Year)<br/>
                                </span>
                                <br/>

                                {{$eth}} ETH<br/>
                                {{$usd}} USD<br/>
                                <strong>{{$address}}</strong><br/><br/>
                                <span style="font-size: 120%">
                                    <strong><span id="time">15:00</span></strong>
                                </span>
                            </div>
                        </div>
                        <p>Your account will be setup <strong>automatically</strong> after payment confirmation.</p>
                    </div>
                    <p><strong>Importent: </strong> The amount must be exactly the same, otherwise refunds and processing issues are possible. The amount must be paid in one transaction only, payments in multiple transactions are not supported.</p>

                </div>


            </div>
    </div>


    <script type="text/javascript">
        function startTimer(duration, display) {
            var timer = duration, minutes, seconds;
            setInterval(function () {
                minutes = parseInt(timer / 60, 10)
                seconds = parseInt(timer % 60, 10);

                minutes = minutes < 10 ? "0" + minutes : minutes;
                seconds = seconds < 10 ? "0" + seconds : seconds;

                display.textContent = minutes + ":" + seconds;

                if (--timer < 0) {
                    display.innerHTML = "<span class='text-danger'>Expired</span>";
                }
            }, 1000);
        }

        window.onload = function () {
            var fifteenMinutes = 60 * 15,
                display = document.querySelector('#time');
            startTimer(fifteenMinutes, display);
        };
    </script>
@stop



@section('bottom')

@stop
