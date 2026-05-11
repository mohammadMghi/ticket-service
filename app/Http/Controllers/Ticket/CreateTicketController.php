<?php

namespace App\Http\Controllers\Ticket;

use App\Http\Controllers\Controller;
use App\Http\Requests\Ticket\CreateTicketRequest;
use App\Services\Ticket\Contracts\ITicketService;
use App\Services\Ticket\DTOs\CreateTicketData;
use App\Services\Ticket\ValueObjects\Description;
use App\Services\Ticket\ValueObjects\File;
use App\Services\Ticket\ValueObjects\FilePath;
use App\Services\Ticket\ValueObjects\Title;
use Illuminate\Http\Request;

class CreateTicketController extends Controller
{
    public function __construct(
        public ITicketService $ticketService
    ){}

    public function __invoke(CreateTicketRequest $request)
    {      
        $this->ticketService->create(
            new CreateTicketData(
                new Title($request->title),
                new Description($request->description),
                new FilePath($this->storeFile($request))
            )
        );
    }

    private function storeFile($request) : string
    {
        $file = $request->file('file');
        return $file->store('tickets');
    }
}
