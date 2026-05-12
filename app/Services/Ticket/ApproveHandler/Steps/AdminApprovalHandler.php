<?php

namespace App\Services\Ticket\ApproveHandler\Steps;

use App\Models\Role;
use App\Services\Ticket\ApproveHandler\ApprovalHandler;
use App\Services\Ticket\DTOs\ApproveTicketData;
use App\Services\Ticket\Enums\TicketStatusType;

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
    }
}
