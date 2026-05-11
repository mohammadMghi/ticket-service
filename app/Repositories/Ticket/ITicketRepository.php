<?php

namespace App\Repositories\Ticket;

use App\Models\Ticket;
use App\Services\Ticket\DTOs\CreateTicketData;

interface ITicketRepository
{
    public function create(CreateTicketData $data) : Ticket;
}