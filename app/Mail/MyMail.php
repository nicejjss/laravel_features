<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Mail\Mailer;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
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
        $this->sendmail($mailer);
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

    private function sendMail(Mailer $mailer, int $tried = 1): void
    {
        $maxTries = 3;

        try {
            parent::send($mailer);

        } catch (Throwable $e) {
            $message = $e->getMessage();
            $isRetryException = $this->isRetryException($message);

            if ($isRetryException && $tried < $maxTries) {
                ++$tried;
                sleep(1);
                $this->sendMail($mailer, $tried);
            } else {
                throw $e;
            }
        }
    }

    private function isRetryException(string $message): bool
    {
        foreach ($this->tryExceptions as $tryException) {
            if (Str::contains($message, $tryException)) {
                return true;
            }
        }

        return false;
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
