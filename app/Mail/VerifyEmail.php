<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\URL;

class VerifyEmail extends Notification
{/**
 * The callback that should be used to create the verify email URL.
 *
 * @var \Closure|null
 */
    public static $code;

    /**
     * The callback that should be used to build the mail message.
     *
     * @var \Closure|null
     */
    public static $toMailCallback;

    /**
     * Get the notification's channels.
     *
     * @param mixed $notifiable
     * @return array|string
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Build the mail representation of the notification.
     *
     * @param mixed $notifiable
     * @return MailMessage
     */
    public function toMail($notifiable)
    {
        return $this->buildMailMessage(self::$code);
    }

    /**
     * Get the verification email notification mail message for the given Code.
     *
     * @param string $code
     * @return MailMessage
     */
    protected function buildMailMessage($code)
    {
        return (new MailMessage)
            ->subject(Lang::get('Verify Email Address'))
            //->line(Lang::get('Please click the button below to verify your email address.'))
            ->line(Lang::get(''))
            ->line(Lang::get('Verification code: ') . $code)
            ->line(Lang::get('If you did not create an account, no further action is required.'));
    }

    /**
     * Set a callback that should be used when building the notification mail message.
     *
     * @param \Closure $callback
     * @return void
     */
    public static function toMailUsing($callback)
    {
        static::$toMailCallback = $callback;
    }
}
