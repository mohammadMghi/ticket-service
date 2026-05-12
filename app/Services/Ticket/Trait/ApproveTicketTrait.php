<?php

namespace App\Services\Ticket\Trait;

use App\Services\Ticket\ApproveHandler\Steps\AdminApprovalHandler;
use App\Services\Ticket\ApproveHandler\Steps\SupperAdminApprovalHandler;
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
            $ticket = $this->repo->find($ticket_id);

            $admin_handler = new AdminApprovalHandler($this->repo); 
            $super_admin_handler = new SupperAdminApprovalHandler($this->repo);

            $super_admin_handler->setNext($admin_handler);

            $admin  = $this->userRepo->find($admin_id);

            return $admin_handler->handle($ticket, $admin, $comment);
        });
    }
}