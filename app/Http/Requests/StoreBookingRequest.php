<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreBookingRequest extends FormRequest
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
            //
            'name' => ['required', 'stirng', 'max:255'],
            'phone_number' => ['required', 'stirng', 'max:255'],
            'email' => ['required', 'stirng', 'lowercase', 'email', 'max:255'],
            'started_at' => ['required', 'date', 'after:today'],
            'total_participant' => 'required|integer\min:1',
        ];
    }
}