<?php

namespace App\Services\Ticket\Contracts;

use App\Services\Ticket\DTOs\CreateTicketData;

interface ITicketService
{
    public function create(CreateTicketData $data);

    public function message();
}