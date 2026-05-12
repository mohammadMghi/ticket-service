<?php

namespace App\Jobs;

use App\Services\Ticket\Actions\ApproveTicketAction;
use App\Services\Ticket\Contracts\ITicketService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\InteractsWithQueue;

class ApproveTicketJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable;

    public function __construct(
        protected int $ticketId,
        protected int $adminId,
        protected ?string $comment
    ) {}

    public function handle(ApproveTicketAction $action)
    {
        $action->execute(
            $this->ticketId,
            $this->adminId,
            $this->comment
        );
    }
}