<!DOCTYPE html>
<html lang="en">
<head>

    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-110396202-1"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'UA-110396202-1');
    </script>


    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">


     <link rel="stylesheet" href="{{ URL::asset('css/app.css') }}">


    <link href='http://fonts.googleapis.com/css?family=Varela+Round' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="{{ URL::asset('css/auth.css') }}">


    @yield('head')
</head>
<body>



    @if(Auth::check())
        <div class="container col-xs-6 col-md-6 text-left" style="padding-top:5px;">
            <div class="btn-group" data-toggle="buttons">
                <h3  style="margin:0px;padding:0px;"> [SMS-Verification]</h3>
                @if(Auth::check())
                    <medium class="text-muted">Logged as: {{Auth::user()->email}}</medium>
                @endif
            </div>

        </div>

        <div class="container col-xs-6 text-right" style="padding-top:10px;">
            <div class="btn-group" data-toggle="buttons">
                <a href="/logout" type="button" class="btn btn-dark">Logout</a>
            </div>
        </div>
    @else
        <div class="container col-xs-12 col-md-5 text-left" style="padding-top:5px;">
            <div class="btn-group" data-toggle="buttons">
                <h3 style="margin:0px;padding:0px;"> [SMS-Verification.net]</h3>
            </div>

        </div>

        <div class="container col-xs-12 col-md-7 text-right" style="padding-top:10px;">
            <div class="btn-group" data-toggle="buttons">
                <a  href="/" type="button" class="btn btn-dark">Home</a>
                <a  href="/api" type="button" class="btn btn-dark">Api</a>
                <a  href="/pricing" type="button" class="btn btn-dark">Pricing</a>
                <a  href="/getstarted" type="button" class="btn btn-dark">Register</a>
                <a  href="/login" type="button" class="btn btn-dark">Login</a>
            </div>
        </div>
    @endif





    <div class="container col-xs-12 col-sm-12 col-lg-12 col-md-12">
        @yield('content')
    </div>


    <div class="container col-xs-12 col-sm-12 col-lg-12 col-md-12 text-center" style="padding-top:70px;padding-bottom:30px;">
        <a  href="/">SMS-Verification.net</a> &copy; 2017
        @if(!Auth::check())
            -
            <a  href="/privacy">Privacy</a> |
            <a  href="/terms">Terms</a> |
            <a  href="/api">Api</a> |
            <a  href="/pricing">Pricing</a> |
            <a  href="/contact">Contact</a> |
            <a  href="/register">Register</a> |
            <a  href="/login">Login</a>
        @endif
    </div>





@yield('bottom')

</body>
</html>
