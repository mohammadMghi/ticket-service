<?php

namespace App\Services\Ticket\DTOs;

class MessageTicketData
{
    public function __construct( 
        public readonly string $description,
        public readonly string $file,
    ){}
}