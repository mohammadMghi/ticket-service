<?php

namespace App\Services\Ticket\Enums;

enum TicketStatusType : string {
    case APPROVED = "Approved";
    case PENDDING_NEXT_APPROVAL = "pending_next_approval";
}