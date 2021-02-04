@component('mail::message')
Hi there,

Welcome aboard and thanks for using [{{env('APP_NAME')}}]!

Your account will be setup within 72 hours after your payment is completed.

@component('mail::button', ['url' => 'http://{{env('APP_DOMAIN')}}/login'])
    Login
@endcomponent

Any Questions? Please <a href="https://{{env('APP_DOMAIN')}}/contact">Contact Us</a>.
@endcomponent