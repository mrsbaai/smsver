
@extends('layouts.app')

@include('features')



@section('head')

    <title>[SMS-Verification] Pricing</title>
    <!-- Main Style -->
    <link rel="stylesheet" type="text/css" href="../css/main.css">

    <!--Icon Fonts-->
    <link rel="stylesheet" media="screen" href="../fonts/font-awesome/font-awesome.min.css" />

@stop

@section('content')

    <div class="container col-sm-12 text-center" style="padding-bottom:20px;">
        <h1>Pricing</h1>
    </div>
    <div class="container col-sm-12 text-center">
        <section id="pricing-table">
            <div class="container">
                <div class="row">
                    <div class="pricing col-lg-12">
                        <div class="col-md-4 col-sm-12 col-xs-12">
                            <div class="pricing-table">
                                <div class="pricing-header" style="background-color: #D39D05;">
                                    <p class="pricing-title">Starter Plan</p>
                                    <p class="pricing-rate"><sup>$</sup> 3<span class="smaller">00</span> <span class="small-pricing">/Year.</span></p>
                                    <a href="/getstarted/1" class="btn btn-custom">And Get Free Month</a>
                                </div>

                                <div class="pricing-list">
                                    <ul>
                                        <li><span class="numbers"><i class="fa fa-mobile-phone"></i>200 Numbers</span></li>
                                        @yield('features1')
                                    </ul>
                                </div>



                            </div>
                        </div>

                        <div class="col-md-4 col-sm-12 col-xs-12">
                            <div class="pricing-table">
                                <div class="pricing-header"  style="background-color: #7D1E4A;">
                                    <p class="pricing-title">Business Plan</p>
                                    <p class="pricing-rate"><sup>$</sup> 5<span class="smaller">00</span> <span class="small-pricing">/Year.</span></p>
                                    <a href="/getstarted/2" class="btn btn-custom">And Get Free Month</a>
                                </div>

                                <div class="pricing-list">
                                    <ul>
                                        <li><span class="numbers"><i class="fa fa-mobile-phone"></i>500 Numbers</span></li>
                                        @yield('features2')
                                    </ul>
                                </div>



                            </div>
                        </div>

                        <div class="col-md-4 col-sm-12 col-xs-12">
                            <div class="pricing-table">
                                <div class="pricing-header" style="background-color: #14646D;">
                                    <p class="pricing-title">Extended Plan</p>
                                    <p class="pricing-rate"><sup>$</sup> 7<span class="smaller">00</span> <span class="small-pricing">/Year.</span></p>
                                    <a href="/getstarted/3" class="btn btn-custom">And Get Free Month</a>
                                </div>

                                <div class="pricing-list">
                                    <ul>
                                        <li><span class="numbers"><i class="fa fa-mobile-phone"></i>1000 Numbers</span></li>
                                        @yield('features3')
                                    </ul>
                                </div>



                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </div>

		<br/><br/><br/>
				<center>
			<div style="border: 1px solid #e3e3e3; padding: 10 px; background-color:white;">
		<img  src="/img/world_2.jpg" >
		</div>

	<br/><br/><br/>
			<center><img  src="/img/back.png"  width="150" height="150"></center>
	<div class="container col-sm-12 text-center">
	<div class = "row">
		<br/>
	<p>
	<b>SMS-Verifiction Now Offers a 30-Day Risk-Free Guarantee on ALL Number Plans</b><br/>
	If you're not satisfied, we're not satisfied - so we'll gladly give you your money back on any number plan purchase. While we stand behind the numbers we sell, we want you to feel confident in your purchase decision. As of March 9th, 2019, all orders placed online qualify for a 30-Day Risk-Free Guarantee. If you are not happy with your purchase for ANY reason, please contact us within 30-Days and we will gladly work with you to exchange the numbers or process a refund for the full price the purchase. 

	</p>
	
	</div>
	</div>
	

@stop



@section('bottom')

@stop
