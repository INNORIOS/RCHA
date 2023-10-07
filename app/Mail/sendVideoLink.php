<?php

namespace App\Mail;

use App\Models\Payment;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class sendVideoLink extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     * @var Payment
     */
    private $payment;
    public function __construct(Payment $payment)
    {
        $this->payment =$payment;
    }
    public function build()
    {
        // return $this->from('munyinyaTech@gmail.com','Munyinya Shema Maurice')
        // ->subject($this->data['subject'])->view('emails.index')
        // ->view('emails.index')->with('data',$this->data);
       // return $this->view('sendVideoLinkView');
       return $this->markdown('sendVideoLink.sendVideoLinkView');
    }
    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Mail Notify',
        );
    }

    /**
     * Get the message content definition.
     */
    // public function content(): Content
    // {
    //     return new Content(
    //         view: 'sendVideoLink.sendVideoLinkView',
    //     );
       
    // }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
