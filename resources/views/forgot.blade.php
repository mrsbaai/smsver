
@extends('layouts.app')





@section('head')

    <script src="{{ URL::asset('js/auth.js') }}"></script>
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.13.1/jquery.validate.min.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />

    <title>[SMS-Verification] Recover</title>
@stop

@section('content')
    <br>
    <div class="container marketing col-sm-12 text-center">
        <!-- FORGOT PASSWORD FORM -->
        <div class="text-center" style="padding:50px 0">
            <div class="logo">Forgot password</div>
            <!-- Main Form -->
            <div class="login-form-1">
                {{ Form::open(array('action' => 'userController@forgot', 'id' => 'forgot-password-form', 'class' => 'text-left'))}}

                    <div class="etc-login-form">
                        <p>When you fill in your registered email address, you will be sent instructions on how to reset your password.</p>
                    <br/>
					</div>
                @include('flash::message')
                    <div class="main-login-form">

                        <div class="login-group">
                            <div class="form-group">
                                <label for="fp_email" class="sr-only">Email Address</label>
                                <input type="email" class="form-control" id="fp_email" name="fp_email" placeholder="Email Address"  type="email" required autofocus>
                            </div>
                        </div>
                        <button type="submit" class="login-button"><i class="fa fa-chevron-right"></i></button>
                    </div>
                    <div class="etc-login-form">
					<br/>
                        <p>Already have an account? <a href="#">Login here</a></p>
						<br/>
                        <p>New user? <a href="#">Create an account</a></p>
                    </div>
                {{ Form::close() }}
            </div>
            <!-- end:Main Form -->
        </div>

    </div>




@stop



@section('bottom')

@stop
