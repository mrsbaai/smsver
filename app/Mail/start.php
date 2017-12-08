<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class start extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $address = 'no-replay@sms-verification.net';
        $name = '[SMS-Verification]';
        $subject = 'Welcome To [SMS-Verification] 🚀';

        return $this->markdown('mails.start')
            ->from($address, $name)
            ->subject($subject);
    }
}
