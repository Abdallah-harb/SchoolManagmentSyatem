<?php

namespace App\Services;

use Kreait\Firebase\Factory;
use Kreait\Firebase\Messaging\CloudMessage;
use Kreait\Firebase\Messaging\Notification;

class firebaseService
{
    public function __construct()
    {
        $this->messaging = (new Factory)->withServiceAccount("D:\laragon\www\schoolSystem\storage\app/new-pr-cf6f9-ca7fe484b674.json")
                                 ->createMessaging();
    }

    public function sendNotifyToDevice(array $data): void
    {
        $deviceToken = "e5vJ3gItY9I:APA91bH6uH1iKnJ2yM-XyZq8Bcc3I3T4DfFh7YasV1r_XbY0Cr9X-UF9rbQ-OJxXZ3tkON2Zb8sKvA11qBk2lDIP6_6Q1jXf3Dmd6wBev_TzD--y2eKyyxfSw8g9kiUyP0InU1mTdzguK_Hmj5zwpuHxuQ98T8WvI5Q4ZlHoxl5wG2R5B8pZPhJUnjNFSdQkD7fI3U1g";
        $notification = Notification::create('New Notification', $data['message']);

        $message = CloudMessage::new()
            ->withNotification($notification)
            ->withData($data)
            ->toToken($deviceToken);
        $this->messaging->send($message);
    }
}
