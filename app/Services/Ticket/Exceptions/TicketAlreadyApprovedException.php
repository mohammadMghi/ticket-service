<?php

namespace App\Services\Ticket\Exceptions;

use Exception;
use Illuminate\Http\Request;

class TicketAlreadyApprovedException extends Exception
{
    public function render(Request $request)
    {
        return response()->json([
            'error' => [
                'message' => $this->message
            ]
        ] , 409);
    }
}