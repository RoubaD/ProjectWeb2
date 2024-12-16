<?php
namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactMessageMail extends Mailable
{
    use Queueable, SerializesModels;

    public $name;
    public $messageContent;

    public function __construct($name, $message)
    {
        $this->name = $name;
        $this->messageContent = $message;
    }

    public function build()
    {
        return $this->subject('New Contact Us Message')
            ->view('emails.contact_message')
            ->with([
                'name' => $this->name,
                'messageContent' => $this->messageContent,
            ]);
    }
}
