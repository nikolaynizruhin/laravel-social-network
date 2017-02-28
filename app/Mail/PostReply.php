<?php

namespace App\Mail;

use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class PostReply extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Recipient
     *
     * @var User
     */
    protected $recipient;

    /**
     * Sender.
     *
     * @var User
     */
    protected $sender;

    /**
     * Create a new message instance.
     *
     * @param  User $recipient
     * @param  User $sender
     * @return void
     */
    public function __construct(User $recipient, User $sender)
    {
        $this->recipient = $recipient;
        $this->sender = $sender;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.post-reply')
            ->with(['recipient' => $this->recipient, 'sender' => $this->sender]);
    }
}
