<?php

namespace App\Repositories\Ticket;

use App\Models\ApprovalStep;
use App\Models\Ticket;
use App\Models\TicketApproval;
use App\Services\Ticket\DTOs\ApproveTicketData;
use App\Services\Ticket\DTOs\CreateTicketData;

class TicketRepository implements ITicketRepository
{
    public function create(CreateTicketData $data) : Ticket
    {
        return Ticket::create($data->toArray());
    }
 

    public function find($id)
    {
        return Ticket::find($id);
    }

    public function getApprovalOrderBySteps()
    {
        return ApprovalStep::orderBy('step_order')->get();
    }

    public function getApprovalsCount($ticket_id)
    {
        $ticket = $this->find($ticket_id);

        return $ticket->approvals()->count(); 
    }
 
    public function insertApprove(ApproveTicketData $data)
    {   
        TicketApproval::create([
            'ticket_id' => $data->ticket_id,
            'approved_by' => $data->admin_id,
            'approval_step_id' => $data->current_step_id,
            'comment' => $data->comment,
            'approved_at' => now(),
        ]); 

        $ticket = $this->find($data->ticket_id);
 
        $ticket->update([
            'status' => $data->status
        ]);
    }
}