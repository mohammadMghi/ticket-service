<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class SendAprovalEmailNorification extends Notification implements ShouldQueue
{
     use Queueable;
 
    public $tries = 5;
 
    public $backoff = 3600;

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Notification')
            ->line('This email was sent using queued notification.');
    }
 
    public function failed(\Throwable $exception)
    {
        \Log::error('Email notification failed', [
            'error' => $exception->getMessage(),
        ]);
    }
}
