<?php

namespace App\Services\Ticket\Enums;

enum TicketStatusType : string {
    case APPROVED = "Approved";
    case PENDDING = "Pendding";
}