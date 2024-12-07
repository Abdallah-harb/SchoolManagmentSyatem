<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class RegisterNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public $message, $from , $to ;
    public function __construct($data)
    {
        $this->message = $data['message'];
        $this->from = $data['froms'];
        $this->to = $data['to'];
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['database'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toDatabase(object $notifiable): array
    {
        return [
                "message" => $this->message,
                "from" => $this->from,
                "to" => $this->to,
        ];
    }


}
