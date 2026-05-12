<?php

namespace App\Services\Ticket\ApproveHandler;

use App\Services\Ticket\Exceptions\AdminAllowedApproveException;
use App\Services\Ticket\Exceptions\TicketAlreadyApprovedException;

trait ApproveValidationTrait
{ 

    public function currentApproveStep($ticket_id)
    {
        $approvalSteps = $this->repo->getApprovalOrderBySteps(); 
        $completedApprovals = $this->repo->getApprovalsCount($ticket_id);
       
        return $approvalSteps[$completedApprovals] ?? null;
    }


    public function ensureTicketNotFullApproved($current_step)
    { 
        if (!$current_step) {
            throw new TicketAlreadyApprovedException('Ticket already fully approved.');
        } 
    }

    public function ensureAdminAllowedApprove($admin,$current_step)
    {       
        if ($admin->role_id !== $current_step->role_id) {
            throw new AdminAllowedApproveException('You are not allowed to approve this step.');
        } 
    } 
}