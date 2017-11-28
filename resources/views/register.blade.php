
@extends('layouts.app')





@section('head')

    <link rel="stylesheet" href="{{ URL::asset('css/auth.css') }}">
    <script src="{{ URL::asset('js/auth.js') }}"></script>
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
    <link href='http://fonts.googleapis.com/css?family=Varela+Round' rel='stylesheet' type='text/css'>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.13.1/jquery.validate.min.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />

<title>[SMS-Verification] Register</title>

@stop

@section('content')
    <br>
    <div class="container marketing col-sm-12 text-center">

        <!-- REGISTRATION FORM -->
        <div class="text-center" style="padding:50px 0">
            <div class="logo">Register</div>
            <!-- Main Form -->
            <div class="login-form-1">
                {{ Form::open(array('action' => 'userController@create', 'id' => 'register-form', 'class' => 'text-left'))}}
                    <div class="login-form-main-message"></div>
                    <div class="main-login-form">
                        @include('flash::message')
                        <div class="login-group">


                            <div class="form-group">
                                <label for="reg_email" class="sr-only">Email</label>
                                <input type="email" class="form-control" id="reg_email" name="reg_email" placeholder="email"  required autofocus>
                            </div>

                            <div class="form-group">
                                <label for="reg_password" class="sr-only">Password</label>
                                <input type="password" class="form-control" id="reg_password" name="reg_password" placeholder="password" required>
                            </div>
                            <div class="form-group">
                                <label for="reg_password_confirm" class="sr-only">Password Confirm</label>
                                <input type="password" class="form-control" id="reg_password_confirm" name="reg_password_confirm" placeholder="confirm password" required>
                            </div>
                            <div class="form-group login-group-checkbox">
                                <input type="checkbox" class="" id="reg_agree" name="reg_agree" required>
                                <label for="reg_agree">I agree with <a href="/terms">terms</a></label>
                            </div>

                        </div>
                        <button type="submit" class="login-button"><i class="fa fa-chevron-right"></i></button>
                    </div>
                    <div class="etc-login-form">
                        <p>Already have an account? <a href="/login">login here</a></p>
                    </div>
                {{ Form::close() }}
            </div>
            <!-- end:Main Form -->
        </div>

    </div>




@stop



@section('bottom')

@stop
