
@extends('layouts.app')


@section('head')

    <!-- Open Graph data -->
    <meta property="og:title" content="[{{env('APP_NAME')}}]" />
    <meta property="og:type" content="WebSite" />
    <meta property="og:description" content="Reliable API to Bypass SMS Verification" />
    <meta property="og:site_name" content="[{{env('APP_NAME')}}]" />
    <meta name="keywords" content="sms, verification">
    <meta name="description" content="Reliable API to Bypass SMS Verification">
    <title>[{{env('APP_NAME')}}]</title>
	<style>
	.converter a {
		background: -webkit-linear-gradient(90deg, #ECE9E6 10%, #FFFFFF 90%);
		background: -moz-linear-gradient(90deg, #ECE9E6 10%, #FFFFFF 90%);
		background: -ms-linear-gradient(90deg, #ECE9E6 10%, #FFFFFF 90%);
		background: -o-linear-gradient(90deg, #ECE9E6 10%, #FFFFFF 90%);
		background: linear-gradient(90deg, #ECE9E6 10%, #FFFFFF 90%);
		padding: 23px 37px;
		border-radius: 5px;
		color: #333;
		display: inline-block;
		position: relative;
		padding: 0.64286em 0.85714em 0.53571em;
		color: #fff;
		font: 400 35px/1 “proxima-nova”, ‘Open Sans’, Helvetica, sans-serif;
		background: #D74445;
		z-index: 3;
		border-radius: 6px;
		box-shadow: 0 6px 0 #181C22,0 6px 3px rgba(0,0,0,0.4);
	}
	.converter a:hover, .converter a:focus {
		color: #fff;
		background: #c92b2c;
		box-shadow: 0 6px 0 #181C22,0 6px 3px rgba(0,0,0,0.4);
	}
	
	
	.converter a:active {
		top: 6px;
		box-shadow: 0 0px 0 #009FC4,0 0 0 rgba(0,0,0,0.4);
	}
	</style>

@stop

@section('content')

    <div class="container col-sm-12 col-md-12 col-lg-12 text-center" style="padding-bottom:70px;">
        <h1>{{env('APP_NAME')}}</h1>
        <h3 >A Simple API Service To Bypass SMS Verification Anywhere</h3>
		
    </div>
	@if(Session::has('message'))
<script>alert('{{ Session::get("message") }}');</script>
@endif

    <div class="container width-fix col-sm-12">
        <div class="jumbotron" >
<!--<br/><br/>
		<center><img  src="/img/world_1.png" ></center>
		<br/> -->
            <h2>Example:</h2>
            <p>Send SMS Messages to these numbers and see inbound messages below.</p>

            <div class="table-responsive">
                <table class="table table-condensed">
                    <thead>
                    <tr>
                        <th>[Number]</th>
                        <th>[Country]</th>

                    </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><b><h3 stye="padding:0px;">[+1 613 777 9527]</h3></b></td>
                            <td><h3 stye="padding:0px;">United States</h3></td>
                        </tr>

                    </tbody>

                </table>

            </div>

            <h3>Inbound Messages - <span style="font-size:70%">(Refresh to see latest)</span></h3>
            @if(count($messages) == 0)
                <p id="emp">Empty.</p>
            @else
            <div class="container-fluid nopadding">
                <div id="messages-table-container" class="nopadding">
                    <div id="no-more-tables">


                        <table id="messages-table" class="col-md-12 table messages-table table-condensed cf">
                            <thead class="cf">
                            <tr>
                                <th class="th-time">[Time]</th>
                                <th class="td-from">[From]</th>
                                <th>[To]</th>
                                <th>[Message]</th>

                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($messages as $message)
                                <tr>
                                    <td data-title="[Date]" class="td-date" title="{{$message->date}}">[{{$message->date}}]</td>
                                    <td data-title="[From]" class="td-from">[{{$message->sender}}]</td>
                                    <td data-title="[To]" class="td-to">[{{$message->receiver}}]</td>

                                    <td data-title="[Message]" class="td-message">[{{$message->message}}]</td>
                                </tr>
                            @endforeach

                            </tbody>
                        </table>



                    </div>
                </div>
                <center>{{ $messages->links() }}</center>
            </div>
			@endif

        </div>
    </div>

    <div class="container marketing col-sm-12 text-center">
<br/><br/>
        <!-- Three columns of text below the carousel -->
        <div class="row">
            <div class="col-lg-3">
                <img class="rounded-circle" src="/img/cheap.png" alt="Generic placeholder image" width="140" height="140">
                <h2>It's CHEAP</h2>
                <p>Cheap numbers with simple hosted inbox.</p>

            </div><!-- /.col-lg-4 -->
            <div class="col-lg-3">
                <img class="rounded-circle"  src="/img/api.png" alt="Generic placeholder image" width="140" height="140">
                <h2>For DEVELOPERS</h2>
                <p>Simple and reliable API service for websites and software automation.</p>

            </div><!-- /.col-lg-4 -->
            <div class="col-lg-3">
                <img class="rounded-circle" src="/img/anonymous.png" alt="Generic placeholder image" width="140" height="140">
                <h2>ANONYMOUS</h2>
                <p>We never ask for any personal information, and you can completely delete your account.</p>

            </div><!-- /.col-lg-4 -->
            <div class="col-lg-3">
                <img class="rounded-circle" src="/img/world.png" alt="Generic placeholder image" width="140" height="140">
                <h2>And WORLDWIDE</h2>
                <p>Hosted SIM cards from all around the world.</p>

            </div><!-- /.col-lg-4 -->
        </div><!-- /.row -->


    </div>


    <div class="col-lg-12 text-center" style="padding-top: 70px;">
	<div class="converter"><a href="/getstarted"> Get Started! </a></div>  
    </div>
	
	
	<div class="col-lg-12 text-center" style="padding-top: 100px;">
		<center>
        <img  style = "border: 1px solid #e3e3e3;" src="/img/world_2.png" >
        
		</center>
	</div>


   


@stop



@section('bottom')

@stop
