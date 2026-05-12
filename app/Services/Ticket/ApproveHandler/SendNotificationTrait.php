<?php

namespace App\Services\Ticket\ApproveHandler;

use App\Notifications\SendAprovalEmailNorification;

trait SendNotificationTrait
{
    public function sendNotification($ticket)
    {
        $user = $this->userRepo->find($ticket->user_id);

        $user->notify(new SendAprovalEmailNorification());
    }
}