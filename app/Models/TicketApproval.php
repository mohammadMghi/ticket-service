<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TicketApproval extends Model
{
    public function approver()
    {
        return $this->belongsTo(User::class, 'approved_by');
    }

    public function approvalStep()
    {
        return $this->belongsTo(ApprovalStep::class);
    }
}
