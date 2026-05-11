<?php

namespace App\Services\Ticket\DTOs;

use App\Services\Ticket\Enums\TicketStatusType;
use App\Services\Ticket\ValueObjects\Description;
use App\Services\Ticket\ValueObjects\FilePath;
use App\Services\Ticket\ValueObjects\Title;

class CreateTicketData
{
    public function __construct(
        public readonly Title $title,
        public readonly Description $description,
        public readonly FilePath $file,
    ){}

    public function toArray()
    {
        return [
            'title' => $this->title->value(),
            'description' => $this->description->value(),
            'file_path' => $this->file->value(),
            'status' => TicketStatusType::PENDDING->value,
            'user_id' => auth()->user()->id
        ];
    }
}