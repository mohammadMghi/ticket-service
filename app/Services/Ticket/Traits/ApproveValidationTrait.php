<?php

namespace App\Services\Ticket\Traits;

use App\Services\Ticket\ApproveHandler\Steps\AdminApprovalHandler;
use App\Services\Ticket\ApproveHandler\Steps\SupperAdminApprovalHandler; 
use App\Services\Ticket\Exceptions\AdminAllowedApproveException;
use App\Services\Ticket\Exceptions\TicketAlreadyApprovedException;
use DB;

trait ApproveValidationTrait
{  
    public function validation($ticket,$admin)
    {
        $current_steps = $this->currentApproveStep($ticket->id);
   
        $this->ensureTicketNotFullApproved($current_steps);

        $this->ensureAdminAllowedApprove($admin,$current_steps);
    }

    public function currentApproveStep($ticket_id)
    {
        $approvalSteps = $this->repo->getApprovalOrderBySteps(); 
        $completedApprovals = $this->repo->getApprovalsCount($ticket_id);
       
        return $approvalSteps[$completedApprovals] ?? null;
    }


    private function ensureTicketNotFullApproved($current_step)
    {  
        if (!$current_step) {
            throw new TicketAlreadyApprovedException('Ticket already fully approved.');
        } 
    }

    private function ensureAdminAllowedApprove($admin,$current_step)
    {       
        if ($admin->role_id !== $current_step->role_id) {
            throw new AdminAllowedApproveException('You are not allowed to approve this step.');
        }  
    } 
}