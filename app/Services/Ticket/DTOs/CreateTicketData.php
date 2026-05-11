<?php

namespace App\Services\Ticket\DTOs;

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
            'file' => $this->file->value(),
        ];
    }
}