
@extends('layouts.app')




@section('head')

    <title>[SMS-Verification] Payment</title>
    <!-- Main Style -->
    <link rel="stylesheet" type="text/css" href="../css/main.css">

    <!--Icon Fonts-->
    <link rel="stylesheet" media="screen" href="../fonts/font-awesome/font-awesome.min.css" />

@stop

@section('content')
<br/><br/><br/>
    <div class="container"  style="background: white; border-radius: 10px;">
	<div class="card-body">
      <div class="text-center">
        <h1>Payment</h2>
        </div>
      <div class="row">
        <div class="col-md-4 order-md-1 mb-4">
          <h3 class="d-flex justify-content-between align-items-center mb-3">
            <span class="text-muted">Your cart</span>
          </h4>
          <ul class="list-group mb-3">
            <li class="list-group-item d-flex justify-content-between lh-condensed">
              <div>
                <h6 class="my-0">Plan</h6>
                <small class="text-muted">{{$plan}}</small>
              </div>
              <span class="text-muted">${{$original}}</span>
            </li>
            <li class="list-group-item d-flex justify-content-between lh-condensed">
              <div>
                <h6 class="my-0">Amount</h6>
                <small class="text-muted"><b>{{$numbers}} Numbers</b></small>
              </div>
            </li>
            <li class="list-group-item d-flex justify-content-between lh-condensed">
              <div>
                <h6 class="my-0">Period</h6>
                <small class="text-muted">1 Year (Plus 1 Free Month)</small>
              </div>
            </li>            
			<li class="list-group-item d-flex justify-content-between lh-condensed">
              <div>
                <h6 class="my-0">Contact</h6>
                <small class="text-muted">{{$email}}</small>
              </div>
            </li>
            <li class="list-group-item d-flex justify-content-between bg-light">
              <div class="text-success">
                <h6 class="my-0">Promo code</h6>
                <small>{{$code}}</small>
              </div>
              
            </li>
            <li class="list-group-item d-flex justify-content-between">
              <span>Total (USD)</span>
              <strong>${{$usd}}</strong>
            </li>
          </ul>
		  
		  {{Form::open(array('action' => 'userController@redeem', 'class' => 'form-inline text-center'))}}
		  <div class="form-group mb-2">
			<input type="text" class="form-control" id="code" name="code" placeholder="Promo code?">
		  </div>
		  <button type="submit" class="btn btn-default mx-sm-3  mb-2">Redeem</button>
		
		{{Form::close()}}


        </div>
        <div class="col-md-8 order-md-2">
		

		<br/><br/><br/><br/>
		<div class="container marketing col-sm-12 text-center">
			<h3 class="mb-3">Please Choose A Payment Method:</h3>
      
       <!-- <a href="/paypal" class="btn btn-lg paybutton paypal" aria-disabled="true"><span><i class="fa fa-paypal"></i> PayPal </span></a>  -->
       <a href="#" class="btn btn-lg paybutton btn-secondary" role="button"  aria-disabled="true"><span><i class="fa fa-paypal"></i> PayPal </span></a> 


      <a href="/bitcoin" class="btn btn-lg paybutton bitcoin"><span><i class="fa fa-bitcoin"></i> Bitcoin </span></a>
      
      <br/><br/>

      <span class="badge badge-warning">(PayPal payments are temperately unavailable.)</span>
      

		</div>


        
        </div>
      </div>

    </div>
    </div>



@stop



@section('bottom')

@stop
