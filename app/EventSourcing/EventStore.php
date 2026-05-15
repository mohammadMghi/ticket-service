<?php

namespace App\EventSourcing;

use DB;

class EventStore
{
    public function append(string $aggregate_id , string $aggregate_type,object $event , int $version)
    {   
        DB::table('event_stores')->insert([
            'aggregate_id' => $aggregate_id,
            'aggregate_type' => $aggregate_type,
            'event_type' => get_class($event),
            'payload' => collect(get_object_vars($event))->except('socket')->toArray(),
            'version' => $version,
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }

    public function getEvents($aggregate_id)
    {
        return DB::table('event_stores')
            ->where('aggregate_id', $aggregate_id)
            ->orderBy('version')
            ->get();
    }
}