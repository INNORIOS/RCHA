<?php
namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class sendFreeToken extends Mailable
{
    use Queueable, SerializesModels;

    private $paidToken;

    public function __construct($paidToken)
    {
        $this->paidToken = $paidToken;
    }

    public function build()
    {
        return $this
            ->subject('Your Free Token')
            ->markdown('emails.sendFreeToken', [
                'paidToken' => $this->paidToken,
            ]);
    }
}
