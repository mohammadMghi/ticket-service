<?php

namespace App\Http\Controllers\Admin\Ticket;

use App\Http\Controllers\Controller;
use App\Http\Requests\ApproveTicketRequest;
use App\Models\Ticket;
use App\Services\Ticket\Contracts\ITicketService;
use Illuminate\Http\Request;

class ApproveTicketController extends Controller
{
    public function __construct(protected ITicketService $ticketService){}

    public function __invoke(ApproveTicketRequest $request,$ticket_id)
    {    
        $admin = auth()->user(); 

        $this->ticketService->approve($ticket_id,$admin->id,$request->comment);
    }
}
