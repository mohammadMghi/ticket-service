<?php

namespace App\Services\Ticket\ApproveHandler;

trait CurrentApproveStepTrait
{ 
    public function currentApproveStep($ticket_id)
    {
        $approvalSteps = $this->repo->getApprovalOrderBySteps(); 
        $completedApprovals = $this->repo->getApprovalsCount($ticket_id);
       
        return $approvalSteps[$completedApprovals] ?? null;
    }
}