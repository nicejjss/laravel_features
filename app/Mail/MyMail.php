<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Mockery\Exception;
use Throwable;

class MyMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public function __construct()
    {
        //
    }

    // public function shouldQueue(): bool
    // {
    //     return false;
    // }

//    public function queue($queue = null)
//    {
//        return false;
//    }


    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'My Mail',
        );
    }

    /**
     * @throws \Exception
     */
    public function send($mailer)
    {
        $tries = 3;
        while($tries) {
            try {
                throw new Exception("Some error occurred.");
                parent::send($mailer);
                Log::info('Send Success');
                break;
            } catch (Throwable $e) {
                Log::info($e->getMessage() . 123);
                --$tries;
            }
        }
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'mail.test',
        );
    }

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
