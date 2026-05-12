<?php

namespace App\Services\Ticket\Actions;

use App\Repositories\Auth\IUserRepository;
use App\Repositories\Ticket\ITicketRepository;
use App\Services\Ticket\ApproveHandler\Steps\AdminApprovalHandler;
use App\Services\Ticket\ApproveHandler\Steps\SupperAdminApprovalHandler;
use App\Services\Ticket\Trait\ApproveTicketTrait;
use App\Services\Ticket\Traits\ApproveValidationTrait;
use DB;

class ApproveTicketAction
{  
    use ApproveValidationTrait;
    public function __construct(
        protected ITicketRepository $repo,
        protected IUserRepository $userRepo
    ) {}

    public function execute($ticket_id, $admin_id, $comment)
    {
        return DB::transaction(function () use ($ticket_id, $admin_id, $comment) {
            $ticket = $this->repo->find($ticket_id);

            $admin  = $this->userRepo->find($admin_id);

            $this->validation($ticket, $admin);
  
            $adminHandler = resolve(AdminApprovalHandler::class);

            $superAdminHandler = resolve(SupperAdminApprovalHandler::class);
 
            $adminHandler->setNext($superAdminHandler);

            return $adminHandler->handle($ticket, $admin, $comment);
        });
    }
}
