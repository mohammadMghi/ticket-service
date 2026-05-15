<?php

namespace App\Aggregates;
 

class TicketAggregate
{
    public int $user_id;
    public string $status;
    public string $ticketId;
    public string $title;
    public string $description;

    public function applyTicketApproved($event)
    { 
        $this->ticketId = $event->ticketId; 
        $this->status = $event->status;
        $this->title = $event->title;
        $this->description = $event->description;
    }

    public function applyTicketPendding($event) 
    {
        $this->ticketId = $event->ticketId; 
        $this->status = $event->status;
        $this->title = $event->title;
        $this->description = $event->description;
    }
}