<?php

namespace App\Mail;

use App\Models\Result;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class SpeedtestCompletedMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $result;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Result $result)
    {
        $this->result = $result;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Speedtest Result #'.$this->result->id.' - Completed',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            markdown: 'emails.speedtest-completed',
            with: [
                'id' => $this->result->id,
                'url' => url('/admin/results'),
            ],
        );
    }

    /**
     * Get the attachments for the message.
     */
    public function attachments(): array
    {
        return [];
    }
}
