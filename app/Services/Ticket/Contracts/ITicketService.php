<?php

namespace App\Services\Ticket\Contracts;

use App\Services\Ticket\DTOs\CreateTicketData;

interface ITicketService
{
    public function create(CreateTicketData $data);

    public function approve($ticket_id,$admin_id,$comment);

    public function approveBulk(array $ticket_ids,$admin_id,$comment);
}