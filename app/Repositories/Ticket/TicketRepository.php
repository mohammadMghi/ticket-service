<?php

namespace App\Repositories\Ticket;

use App\Models\Ticket;
use App\Services\Ticket\DTOs\CreateTicketData;

class TicketRepository implements ITicketRepository
{
    public function create(CreateTicketData $data) : Ticket
    {
        return Ticket::create($data->toArray());
    }
}