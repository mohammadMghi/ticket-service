<?php

namespace App\Http\Controllers\Admin\Ticket;

use App\Http\Controllers\Controller;
use App\Http\Requests\Ticket\ApprovalBulkRequest;
use App\Services\Ticket\Contracts\ITicketService;
use Illuminate\Http\Request;

class ApproveBulkTicktController extends Controller
{
    public function __construct(protected ITicketService $ticketService){}

    public function __invoke(ApprovalBulkRequest $request)
    {    
        $admin = auth()->user(); 
 
        $this->ticketService->approveBulk(
            $request->ticket_ids, 
            $admin->id,
            $request->comment
        );
    }
}
