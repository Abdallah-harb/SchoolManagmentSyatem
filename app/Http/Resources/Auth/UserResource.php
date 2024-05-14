<?php

namespace App\Http\Resources\Auth;

use App\Enum\GenderEnum;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "id" => $this->id,
            "first_name" => $this->first_name,
            "last_name" => $this->last_name,
            "email" =>$this->email,
            "email_verified_at" => $this->email_verified_at,
            "phone" => $this->phone,
            "phone_verified_at" => $this->phone_verified_at,
            "gender"=> GenderEnum::from($this->gender)->name,
            "image" => asset('storage/users/'.$this->image),
            "address" => $this->address,
            'token' => $this->when($this->token, $this->token)
        ];
    }
}
