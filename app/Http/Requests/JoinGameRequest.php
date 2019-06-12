<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Models\UserGame;

class JoinGameRequest extends FormRequest
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
            'user_id' => 'required|exists:users',
            'booking_id' => 'required|exists:user_court_bookings',
            'status' => ['required', Rule::in([UserGame::STATUS_CANCELLED, UserGame::STATUS_G])],
        ];
    }
}
