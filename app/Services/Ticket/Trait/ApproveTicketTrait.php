<?php

namespace App\Services\Ticket\Trait;

use App\Services\Ticket\DTOs\ApproveTicketData;
use App\Services\Ticket\Enums\TicketStatusType;
use App\Services\Ticket\Exceptions\AdminAllowedApproveException;
use App\Services\Ticket\Exceptions\TicketAlreadyApprovedException;
use DB;

trait ApproveTicketTrait
{
    public function approve($ticket_id,$admin_id,$comment) : string
    {
        return DB::transaction(function () use ($ticket_id, $admin_id, $comment) {
            $admin = $this->userRepo->find($admin_id);

            $approvalSteps = $this->repo->getApprovalOrderBySteps();

            $current_step = $this->getCurrentApproveStep($ticket_id);

            $this->ensureTicketNotFullApproved($current_step);     
        
            $this->ensureAdminAllowedApprove($admin,$current_step);

            $completed_approvals = $this->repo->getApprovalsCount($ticket_id);
 
            $is_last_step = $this->isLastStep($completed_approvals,$approvalSteps);

            $status = $this->status($is_last_step);

            $this->repo->insertApprove(new ApproveTicketData(
                $ticket_id,
                $admin->id,
                $current_step->id,
                $comment,
                $status
            ));

            return $is_last_step
                    ? 'Ticket fully approved.'
                    : 'Approval completed. Waiting for next approver.';
        });
    }
    public function getCurrentApproveStep($ticket_id)
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

    public function ensureAdminAllowedApprove($user,$current_step)
    { 
        if ($user->role_id !== $current_step->role_id) {
            throw new AdminAllowedApproveException('You are not allowed to approve this step.');
        } 
    }

    public function status($is_last_step)
    {
        return $is_last_step ? TicketStatusType::APPROVED : TicketStatusType::PENDDING_NEXT_APPROVAL;
    }

    public function isLastStep($completed_approvals,$steps)
    {
        return $completed_approvals + 1 === $steps->count();
    }
}