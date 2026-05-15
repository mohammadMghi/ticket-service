<?php

namespace App\Http\Controllers;

use App\Services\Ticket\Contracts\ITicketService;
use Illuminate\Http\Request;

class ShowTicketEventsController extends Controller
{
    public function __construct(protected ITicketService $ticketService)
    {}

    public function __invoke()
    {
        $ticket = $this->ticketService->loadTicket(1);

        return response()->json([ 
            'status' => $ticket->status
        ]);
    }
}
