
@extends('layouts.app')





@section('head')
    @include('recaptcha::script')
    <link rel="stylesheet" href="{{ URL::asset('css/auth.css') }}">
    <script src="{{ URL::asset('js/auth.js') }}"></script>
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
    <link href='http://fonts.googleapis.com/css?family=Varela+Round' rel='stylesheet' type='text/css'>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.13.1/jquery.validate.min.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />

    <title>[SMS-Verification] Contact</title>

@stop

@section('content')
    <br>

    <div class="container marketing col-sm-12 text-center">

        <!-- Where all the magic happens -->
        <!-- LOGIN FORM -->
        <div class="text-center" style="padding:50px 0">
            <div class="logo">Contact Us</div>
            <!-- Main Form -->
            <div class="login-form-1" style="  width: 600px;max-width: 600px;">


                {{ Form::open(array('action' => 'userController@contact', 'id' => 'contact-form', 'class' => 'text-left'))}}

                <div class="main-login-form">
                    @include('flash::message')
                    @if($errors->any())
                        {{ implode('', $errors->all('<div>:message</div>')) }}
                    @endif
                    <div class="login-group">
                        <div class="form-group">
                            <label for="lg_email" class="sr-only">Email</label>
                            <input type="email" class="form-control" id="lg_email" name="lg_email" placeholder="Your Email Address" required autofocus>
                        </div>
                        <div class="form-group">
                            <label for="lg_subject" class="sr-only">Subject</label>
                            <input type="text" class="form-control" id="lg_subject" name="lg_subject" placeholder="Subject" required>
                        </div>
                        <div class="form-group">
                            <label for="lg_message" class="sr-only">Message</label>
                            <textarea class="form-control" id="lg_message" name="lg_message" placeholder="Message" required></textarea>
                        </div>
                        @include('recaptcha::widget')

                    </div>
                    <button type="submit" class="login-button"><i class="fa fa-chevron-right"></i></button>
                </div>

                {{ Form::close() }}
            </div>
            <!-- end:Main Form -->
        </div>


    </div>




@stop



@section('bottom')

@stop
