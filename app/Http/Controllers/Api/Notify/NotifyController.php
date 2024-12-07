<?php

namespace App\Http\Controllers\Api\Notify;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Notifications\RegisterNotification;
use App\Services\firebaseService;
use Illuminate\Http\Request;

class NotifyController extends Controller
{
    public function __construct(public firebaseService $firebaseService)
    {

    }
    public function sendNotify(Request $request){

        $admin = User::find(2);
        $data = [
            "message" => request('message'),
            "froms" => auth()->id(),
            "to" => $admin->id,
        ];

        auth('api')->user()->notify(new RegisterNotification($data));
        // firebase notify
        $this->firebaseService->sendNotifyToDevice($data);

        return jsonResponse([],"notify send successfully");
    }


}
