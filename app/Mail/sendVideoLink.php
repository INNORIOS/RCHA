<?php

namespace App\Mail;
use App\Models\User;
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
     * @var User
     */
    private $user;
    public function __construct(User $user)
    {
        $this->user =$user;
    }
    public function build()
    {
        
       return $this
       ->subject('Welcome to RCHA site')
       ->markdown('sendVideoLink.sendVideoLinkView',
    ['name'=> $this->user->first_name]);
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