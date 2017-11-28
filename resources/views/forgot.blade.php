
@extends('layouts.app')





@section('head')

    <link rel="stylesheet" href="{{ URL::asset('css/auth.css') }}">
    <script src="{{ URL::asset('js/auth.js') }}"></script>
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
    <link href='http://fonts.googleapis.com/css?family=Varela+Round' rel='stylesheet' type='text/css'>
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
                <form id="forgot-password-form" class="text-left">
                    <div class="etc-login-form">
                        <p>When you fill in your registered email address, you will be sent instructions on how to reset your password.</p>
                    </div>
                    <div class="login-form-main-message"></div>
                    <div class="main-login-form">
                        <div class="login-group">
                            <div class="form-group">
                                <label for="fp_email" class="sr-only">Email address</label>
                                <input type="text" class="form-control" id="fp_email" name="fp_email" placeholder="email address"  type="email" required autofocus>
                            </div>
                        </div>
                        <button type="submit" class="login-button"><i class="fa fa-chevron-right"></i></button>
                    </div>
                    <div class="etc-login-form">
                        <p>already have an account? <a href="#">login here</a></p>
                        <p>new user? <a href="#">create new account</a></p>
                    </div>
                </form>
            </div>
            <!-- end:Main Form -->
        </div>

    </div>




@stop



@section('bottom')

@stop
