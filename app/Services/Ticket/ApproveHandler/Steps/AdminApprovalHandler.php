<?php

namespace App\Services\Ticket\ApproveHandler\Steps;

use App\Events\ApprovedTicketEvent;
use App\Events\TicketApproved;
use App\EventSourcing\EventStore;
use App\Models\Role;
use App\Services\Ticket\ApproveHandler\ApprovalHandler;
use App\Services\Ticket\DTOs\ApproveTicketData;
use App\Services\Ticket\Enums\TicketStatusType;
use Str;

class AdminApprovalHandler extends ApprovalHandler
{   
    protected function canHandle($admin): bool
    {  
        return $admin->role_id === Role::ADMIN;
    } 

    protected function process($ticket, $admin, $comment): void
    {   
        $current_step = $this->currentApproveStep($ticket->id); 
        
        $this->repo->insertApprove(new ApproveTicketData(
            $ticket->id,
            $admin->id,
            $current_step->id,
            $comment,
            TicketStatusType::PENDDING_NEXT_APPROVAL
        )); 
        
        $event = new TicketApproved(
            $ticket->id,
            TicketStatusType::PENDDING_NEXT_APPROVAL->value,
            $ticket->description,
            $ticket->title,
        );
 
        app(EventStore::class)->append(
            $ticket->id,
            'Ticket',
            $event,
            1
        );
    }
}
