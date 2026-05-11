<?php

namespace App\Services\Ticket\Trait;

use App\Services\Ticket\Enums\TicketStatusType;
use App\Services\Ticket\Exceptions\TicketAlreadyApprovedException;

trait ApproveTicketTrait
{
    public function getCurrentApproveStep($ticket_id)
    {
        $steps = $this->repo->getApprovalOrderBySteps(); 

        $completedApprovals = $this->repo->getApprovalsCount($ticket_id);
    
        return $steps[$completedApprovals] ?? null;
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
            return response()->json([
                'message' => 'You are not allowed to approve this step.'
            ], 403);
        }
    }

    public function status($is_last_step)
    {
        return $is_last_step ? TicketStatusType::APPROVED : TicketStatusType::PENDDING;
    }

    public function isLastStep($completed_approvals,$steps)
    {
        return $completed_approvals + 1 === $steps->count();
    }
}