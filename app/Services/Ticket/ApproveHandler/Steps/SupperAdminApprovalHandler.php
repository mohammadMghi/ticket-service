<?php

namespace App\Services\Ticket\ApproveHandler\Steps;

use App\Models\Role;
use App\Services\Ticket\ApproveHandler\ApprovalHandler;
use App\Services\Ticket\DTOs\ApproveTicketData;
use App\Services\Ticket\Enums\TicketStatusType;
use App\Services\Ticket\Exceptions\AdminAllowedApproveException;
use App\Services\Ticket\Exceptions\TicketAlreadyApprovedException;

class SupperAdminApprovalHandler extends ApprovalHandler
{ 
    protected function canHandle($admin): bool
    { 
        return $admin->role_id === Role::SUPER_ADMIN;
    } 

    protected function process($ticket, $admin, $comment): void
    {
        $current_step = $this->currentApproveStep($ticket->id);
   
        $this->ensureTicketNotFullApproved($current_step);

        $this->ensureAdminAllowedApprove($admin,$current_step); 

        $this->repo->insertApprove(new ApproveTicketData(
            $ticket->id,
            $admin->id,  
            $current_step->id,
            $comment,
            TicketStatusType::APPROVED
        ));
    } 
}
