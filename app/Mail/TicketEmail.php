<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class TicketEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $ticketHtml;

    /**
     * Create a new message instance.
     *
     * @param  string  $ticketHtml
     * @return void
     */
    public function __construct($ticketHtml)
    {
        $this->ticketHtml = $ticketHtml;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $ticketHtml = $this->ticketHtml;

        return $this->html($ticketHtml)
            ->subject('Ticket Details');
    }
    public function attachments(): array
    {
        return [];
    }
}
