<?php

namespace App\Http\Requests\Auth;

use App\Enum\GenderEnum;
use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            "first_name" => "required|string|max:30",
            "last_name" => "required|string|max:30",
            "email" => "required|email|unique:users,email",
            "phone" => "required|string|max:30|unique:users,phone",
            "password" => "required|string|min:6|max:30|confirmed",
            "gender" => ['required','in:0,1'],
            "image" => "required|image|mimes:jpg,jpeg,png,webp|max:2048",
            "birth_date" => "required|date|before:now",
            "address" => "required|string",
        ];
    }
}
