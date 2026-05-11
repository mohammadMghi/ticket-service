<?php

namespace App\Http\Controllers\Admin\Ticket;

use App\Http\Controllers\Controller;
use App\Services\Ticket\Contracts\ITicketService;
use Illuminate\Http\Request;

class ApproveTicketController extends Controller
{
    public function __construct(protected ITicketService $ticketService){}

    public function __invoke()
    { 
        $user = auth()->user();

        
    }
}
