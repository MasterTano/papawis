<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\ZeroMinute;
use App\Rules\HoursDiffWith;

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
            // 'starts_at' => 'required|date|hours_diff_with:ends_at,2',
            'starts_at' => ['required', 'date', new HoursDiffWith('ends_at', 2)],
            'ends_at' => 'required|date',
        ];
    }
}
