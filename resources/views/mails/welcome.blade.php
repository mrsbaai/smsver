@component('mail::message')
    Hi there,

    Welcome aboard and thanks for joining [{{env('APP_NAME')}}]!

    Please complete your payment. Your account will be setup automatically.

    @component('mail::button', ['url' => 'http://{{env("APP_DOMAIN")}}/login'])
        Login
    @endcomponent

    Any Questions? Please <a href="https://{{env('APP_DOMAIN')}}">Contact Us</a>.
@endcomponent