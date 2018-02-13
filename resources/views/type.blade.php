
@extends('layouts.app')




@section('head')

    <title>[SMS-Verification] Payment</title>
    <!-- Main Style -->
    <link rel="stylesheet" type="text/css" href="../css/main.css">

    <!--Icon Fonts-->
    <link rel="stylesheet" media="screen" href="../fonts/font-awesome/font-awesome.min.css" />

@stop

@section('content')

    <div class="container col-sm-12 text-center" style="padding-bottom:20px;">
        <h1>Please Choose A Payment Option:</h1>
    </div>
    <div class="container marketing col-sm-12 text-center">

        <a href="/paypal" class="btn btn-lg paybutton paypal"><i class="fa fa-paypal"></i> PayPal</a>

        <a href="/bitcoin" class="btn btn-lg paybutton bitcoin"><i class="fa fa-bitcoin"></i> Bitcoin</a>

    </div>



@stop



@section('bottom')

@stop
