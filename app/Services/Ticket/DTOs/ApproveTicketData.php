<?php

namespace App\Services\Ticket\DTOs;

use App\Services\Ticket\Enums\TicketStatusType;

class ApproveTicketData
{
    public function __construct(
        public readonly int $ticket_id,
        public readonly int $admin_id,
        public readonly int $current_step_id,
        public readonly string $comment,
        public readonly TicketStatusType $status,
    ) {}
}