<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TicketApproval extends Model
{
    protected $fillable = [
        'ticket_id',
        'approved_by',
        'approval_step_id',
        'comment',
        'approved_at'
    ];

    public function approver()
    {
        return $this->belongsTo(User::class, 'approved_by');
    }

    public function approvalStep()
    {
        return $this->belongsTo(ApprovalStep::class);
    }
}
