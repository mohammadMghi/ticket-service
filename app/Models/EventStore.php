<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EventStore extends Model
{
    protected $fillable = [
        'aggregate_id',
        'aggregate_type',
        'event_type',
        'payload', 
        'version',
    ];
}
