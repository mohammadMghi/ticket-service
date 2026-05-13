<?php

namespace App\Jobs;

use App\Models\Ticket;
use App\Services\Ticket\ApproveHandler\SendToWebservice;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;
use Throwable;
class SendTicketToWebserviceJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable;

    public $tries = 5;
    public $backoff = 3600;  

    public function __construct(
        protected int $ticketId
    ) {}

    public function handle(SendToWebservice $webservice): void
    {
        try {
            $ticket = Ticket::findOrFail($this->ticketId);

            $webservice->send($ticket);

            Log::info('Ticket sent to webservice successfully', [
                'ticket_id' => $this->ticketId
            ]);

        } catch (Throwable $e) {

            Log::warning('Webservice send failed, will retry', [
                'ticket_id' => $this->ticketId,
                'attempt' => $this->attempts(),
                'error' => $e->getMessage()
            ]);

            throw $e;  
        }
    }

    public function failed(Throwable $exception): void
    {
        Log::error('Ticket webservice job permanently failed', [
            'ticket_id' => $this->ticketId,
            'error' => $exception->getMessage()
        ]);
    }
}