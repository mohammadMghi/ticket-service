<?php

namespace App\Services\Ticket;

use App\Aggregates\TicketAggregate;
use App\EventSourcing\EventStore;
use App\Jobs\ApproveTicketJob; 
use App\Repositories\Auth\IUserRepository;
use App\Repositories\Ticket\ITicketRepository;
use App\Services\Ticket\Actions\ApproveTicketAction;
use App\Services\Ticket\Contracts\ITicketService; 
use App\Services\Ticket\DTOs\CreateTicketData;  

class TicketService implements ITicketService
{ 
     public function __construct(
        protected ITicketRepository $repo,
        protected IUserRepository $userRepo,
        protected ApproveTicketAction $approveAction,
        protected EventStore $evnetStore
        ) 
    {}

    public function create(CreateTicketData $data)
    {    
        return $this->repo->create($data);
    } 

    public function approve($ticket_id,$admin_id,$comment)
    { 
        $this->approveAction->execute($ticket_id,$admin_id,$comment);
    }

    public function approveBulk(array $ticket_ids,$admin_id,$comment)
    { 
        foreach ($ticket_ids as $ticket_id) {
            ApproveTicketJob::dispatch($ticket_id,$admin_id,$comment);
        }
    }

    public function loadTicket($ticketId)
    {
        $events = $this->evnetStore->getEvents($ticketId);

        $aggregate = new TicketAggregate();
        
        foreach ($events as $event) {
            $eventClass = $event->event_type;
            $payload = json_decode($event->payload);
          
            $eventObject = new $eventClass(...(array)$payload);
         
            $method = 'apply'.class_basename($eventClass);
 
            if (method_exists($aggregate, $method)) {
                $aggregate->$method($eventObject);
            }
        }

        return $aggregate;
    }
}