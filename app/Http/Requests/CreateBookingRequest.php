<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateBookingRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'court_id' => 'required|exists:courts',
            'user_id' => 'required|exists:users',
            'inclusion' => 'required|string',
            'starts_at' => 'required|date',
            'ends_at' => 'required|date'
        ];
    }
}