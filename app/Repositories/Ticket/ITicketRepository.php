<?php

namespace App\Repositories\Ticket;

use App\Models\Ticket;
use App\Services\Ticket\DTOs\ApproveTicketData;
use App\Services\Ticket\DTOs\CreateTicketData;

interface ITicketRepository
{
    public function create(CreateTicketData $data) : Ticket; 

    public function getApprovalOrderBySteps();

    public function getApprovalsCount($ticket_id);
 
    public function insertApprove(ApproveTicketData $data);
}    