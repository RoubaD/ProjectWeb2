<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Queue\SerializesModels;

class ContactMessageSent implements ShouldBroadcast
{
    use SerializesModels;

    public $name;
    public $message;

    public function __construct($name, $message)
    {
        $this->name = $name;
        $this->message = $message;
    }

    public function broadcastOn()
    {
        return new Channel('contact-channel');
    }

    public function broadcastAs()
    {
        return 'contact-event';
    }
}
