@component('mail::message')
Hi there,

Welcome aboard and thanks for using [SMS-Verification]!

Your account will be setup within 72 hours after your payment is completed.

@component('mail::button', ['url' => 'http://sms-verification.net/login'])
    Login
@endcomponent

Any Questions? Please <a href="https://sms-verification.net/contact">Contact Us</a>.
@endcomponent