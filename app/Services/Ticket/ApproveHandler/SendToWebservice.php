<?php

namespace App\Services\Ticket\ApproveHandler;

use Exception;
use Illuminate\Support\Facades\Log;

class SendToWebservice
{
    public function send($ticket)
    {
        if (random_int(0, 1)) {
            throw new Exception('Webservice returned 500 error');
        }

        Log::info('Sent to webhook');
    }
}