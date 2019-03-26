
@extends('layouts.app')


@section('head')

    <!-- Open Graph data -->
    <meta property="og:title" content="[SMS-Verification]" />
    <meta property="og:type" content="WebSite" />
    <meta property="og:description" content="Reliable API to Bypass SMS Verification" />
    <meta property="og:site_name" content="[SMS-Verification]" />
    <meta name="keywords" content="sms, verification">
    <meta name="description" content="Reliable API to Bypass SMS Verification">
    <title>[SMS-Verification]</title>

@stop

@section('content')

    <div class="container col-sm-12 col-md-12 col-lg-12 text-center" style="padding-bottom:70px;">
        <h1>SMS-Verification</h1>
        <h3 >A simple API service to bypass SMS verification anywhere</h3>
		<br/><br/><br/>
		<center><img  src="/img/world_1.png" ></center>
    </div>

    <div class="container width-fix col-sm-12">
        <div class="jumbotron" >

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
                            <td><b>[+1 617-766-5162]</b></td>
                            <td>United States</td>
                        </tr>
                        <tr>
                            <td><b>[+1 202-683-9790]</b></td>
                            <td>United States</td>
                        </tr>
                        <tr>
                            <td><b>[+1 720-370-2287]</b></td>
                            <td>United States</td>
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

        <!-- Three columns of text below the carousel -->
        <div class="row">
            <div class="col-lg-3">
                <img class="rounded-circle" src="/img/cheap.png" alt="Generic placeholder image" width="140" height="140">
                <h2>Cheap</h2>
                <p>Dirt cheap numbers with the ability to replace every month</p>

            </div><!-- /.col-lg-4 -->
            <div class="col-lg-3">
                <img class="rounded-circle"  src="/img/api.png" alt="Generic placeholder image" width="140" height="140">
                <h2>DEVELOPERS</h2>
                <p>A reliable API service easy to integrate anywhere.</p>

            </div><!-- /.col-lg-4 -->
            <div class="col-lg-3">
                <img class="rounded-circle" src="/img/anonymous.png" alt="Generic placeholder image" width="140" height="140">
                <h2>ANONYMOUS</h2>
                <p>We never ask for any personal information.</p>

            </div><!-- /.col-lg-4 -->
            <div class="col-lg-3">
                <img class="rounded-circle" src="/img/world.png" alt="Generic placeholder image" width="140" height="140">
                <h2>WORLDWIDE</h2>
                <p>Hosted SIM cards from all around the world.</p>

            </div><!-- /.col-lg-4 -->
        </div><!-- /.row -->


    </div>


    <div class="col-lg-12 text-center" style="padding-top: 70px;">
        <a href="/getstarted" type="button" class="btn btn-lg btn-primary">Get Started Now!</a>
    </div>

    <div class="col-lg-12 text-center" style="padding-top: 100px;">
        <a href="/pricing"><img src="/img/we-accept.png"style="max-height: 150px;"></a>
        
    </div>


    </div>


@stop



@section('bottom')

@stop
