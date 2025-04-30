<?php
namespace App\Services;

use Twilio\Rest\Client;

class WhatsAppService
{
    protected $twilio;

    public function __construct()
    {
        $this->twilio = new Client(config('services.twilio.sid'), config('services.twilio.token'));
    }

    public function sendMessage($to, $message)
    {
        $this->twilio->messages->create(
            "whatsapp:$to",
            [
                'from' => config('services.twilio.whatsapp_from'),
                'body' => $message
            ]
        );
    }
}
