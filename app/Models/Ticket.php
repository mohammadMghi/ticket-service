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
}
