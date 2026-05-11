<?php

namespace App\Services\Ticket;

use App\Models\Ticket;
use App\Repositories\Auth\IUserRepository;
use App\Repositories\Ticket\ITicketRepository;
use App\Services\Ticket\Contracts\ITicketService;
use App\Services\Ticket\DTOs\ApproveTicketData;
use App\Services\Ticket\DTOs\CreateTicketData;
use App\Services\Ticket\Enums\TicketStatusType;
use App\Services\Ticket\Exceptions\TicketAlreadyApprovedException;
use App\Services\Ticket\Trait\ApproveTicketTrait;
use DB;

class TicketService implements ITicketService
{
    use ApproveTicketTrait;

    public function __construct(
        protected ITicketRepository $repo,
        protected IUserRepository $userRepo
        )
    {}

    public function create(CreateTicketData $data)
    {    
        return $this->repo->create($data);
    }

    public function message()
    {

    }

    public function approveByAdmin($ticket_id,$admin_id,$comment)
    {
        return DB::transaction(function () use ($ticket_id, $admin_id, $comment) {
            $admin = $this->userRepo->find($admin_id);
 
            $current_step = $this->getCurrentApproveStep($ticket_id);

            $this->ensureTicketNotFullApproved($current_step);    
        
            $this->ensureAdminAllowedApprove($admin,$current_step);

            $completed_approvals = $this->repo->getApprovalsCount($ticket_id);

            $steps = $this->repo->getApprovalOrderBySteps();

            $is_last_step = $this->isLastStep($completed_approvals,$steps);

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
}