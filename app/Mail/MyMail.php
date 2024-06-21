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

    private array $tryExceptions = [
        'Division',
        'exception',
    ];

    /**
     * Create a new message instance.
     */
    public function __construct()
    {
        //
    }

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
     * @throws Throwable
     */
    public function send($mailer)
    {
        $tries = 1;
        $maxTries = 3;

        while ($tries <= 3) {
            try {
                $a = 1 / 0;

                parent::send($mailer);
                break;
            } catch (Throwable $e) {
                $isRetryException = false;

                foreach ($this->tryExceptions as $tryException) {
                    if (str_contains($e->getMessage(), $tryException)) {
                        $isRetryException = true;
                        break;
                    }
                }

                if ($isRetryException && $tries < $maxTries) {
                    logger()->error('Failed time ' . $tries . ' ' . $e->getMessage());
                    ++$tries;
                    sleep(1);
                } else {
                    throw $e;
                }
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
