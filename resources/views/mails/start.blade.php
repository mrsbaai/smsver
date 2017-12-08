@component('mail::message')
Hi there,

Welcome aboard and thanks for joining [SMS-Verification]!

Please complete your payment. Your account will be setup automatically.

@component('mail::button', ['url' => 'http://sms-verification.net/login'])
    Login
@endcomponent

Any Questions? Please <a href="https://sms-verification.net">Contact Us</a>.
@endcomponent