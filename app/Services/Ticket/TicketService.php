<?php

namespace App\Services\Ticket;

use App\Models\Ticket;
use App\Repositories\Ticket\ITicketRepository;
use App\Services\Ticket\Contracts\ITicketService;
use App\Services\Ticket\DTOs\CreateTicketData;

class TicketService implements ITicketService
{
    public function __construct(protected ITicketRepository $repo)
    {}

    public function create(CreateTicketData $data)
    {    
        return $this->repo->create($data);
    }

    public function message()
    {

    }
}