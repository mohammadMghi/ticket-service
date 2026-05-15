<?php

namespace App\Models;

use App\Services\Ticket\Enums\TicketStatusType;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    protected $casts = [
        'status' => TicketStatusType::class
    ];

    protected $fillable = [
        'title',
        'description',
        'status',
        'user_id',
        'file_path'
    ];
 
    public function user()
    {
        return $this->belongsTo(User::class);
    }
 
    public function approvals()
    {
        return $this->hasMany(TicketApproval::class);
    }
 
    public function latestApproval()
    {
        return $this->hasOne(TicketApproval::class)
            ->latestOfMany();
    }
 
    public function currentApprovalStep()
    {
        $approvedStepIds = $this->approvals()
            ->pluck('approval_step_id');

        return ApprovalStep::whereNotIn('id', $approvedStepIds)
            ->orderBy('step_order')
            ->first();
    }
 
    public function isFullyApproved(): bool
    {
        $totalSteps = ApprovalStep::count();

        return $this->approvals()->count() >= $totalSteps;
    }
}
