<?php 

namespace App\Services\Ticket\ApproveHandler;

use App\Repositories\Ticket\ITicketRepository;
use App\Services\Ticket\Exceptions\AdminAllowedApproveException;
use App\Services\Ticket\Exceptions\TicketAlreadyApprovedException;

abstract class ApprovalHandler
{
    use ApproveValidationTrait;
    protected ?ApprovalHandler $next = null;

    public function __construct(protected ITicketRepository $repo) {}

    public function setNext(ApprovalHandler $handler): ApprovalHandler
    {
        $this->next = $handler;
        return $handler;
    } 

    public function handle($ticket, $admin, $comment)
    {    
        if (!$this->canHandle($admin)) {
            return;
        }

        $this->process($ticket, $admin, $comment);

        if ($this->next) {
            return $this->next->handle($ticket, $admin, $comment);
        }

        return 'Ticket fully approved.';
    }


    abstract protected function process($ticket, $admin, $comment): void;
}
