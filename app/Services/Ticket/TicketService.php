<?php

namespace App\Services\Ticket;

use App\Models\Ticket;
use App\Repositories\Auth\IUserRepository;
use App\Repositories\Ticket\ITicketRepository;
use App\Services\Ticket\Actions\ApproveTicketAction;
use App\Services\Ticket\Contracts\ITicketService;
use App\Services\Ticket\DTOs\ApproveTicketData;
use App\Services\Ticket\DTOs\CreateTicketData;
use App\Services\Ticket\Enums\TicketStatusType;
use App\Services\Ticket\Exceptions\TicketAlreadyApprovedException;
use App\Services\Ticket\Trait\ApproveTicketTrait;
use DB;

class TicketService implements ITicketService
{ 
     public function __construct(
        protected ITicketRepository $repo,
        protected IUserRepository $userRepo,
        protected ApproveTicketAction $approveAction
        ) 
    {}

    public function create(CreateTicketData $data)
    {    
        return $this->repo->create($data);
    } 

    public function approve($ticket_id,$admin_id,$comment)
    { 
        $this->approveAction->execute($ticket_id,$admin_id,$comment);
    }
}