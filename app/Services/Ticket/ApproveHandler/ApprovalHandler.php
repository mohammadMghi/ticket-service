<?php 

namespace App\Services\Ticket\ApproveHandler;

use App\Notifications\SendAprovalEmailNorification;
use App\Repositories\Auth\IUserRepository;
use App\Repositories\Ticket\ITicketRepository; 

abstract class ApprovalHandler
{
    use SendNotificationTrait,CurrentApproveStepTrait;
    protected ?ApprovalHandler $next = null;

    public function __construct(
        protected ITicketRepository $repo,
        protected IUserRepository $userRepo,
        protected SendToWebservice $sendToWebservice
        ) {}

    public function setNext(ApprovalHandler $handler): ApprovalHandler
    {
        $this->next = $handler;
        return $handler;
    } 

    public function handle($ticket, $admin, $comment)
    {     
        if ($this->canHandle($admin)) {
            $this->process($ticket, $admin, $comment);
            $this->sendNotification($ticket);
            return;
        } 
        
        if ($this->next) {
            return $this->next->handle($ticket, $admin, $comment);
        }
    } 
    abstract protected function process($ticket, $admin, $comment): void;
}
