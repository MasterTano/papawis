<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateCourtRequest extends FormRequest
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
            'name' => 'required|string',
            'rate_per_hour' => 'required|numeric',
            'peak_rate_per_hour' => 'required|numeric',
            'minimum_rental_per_hour' => 'required|numeric',
            'operating_hour' => 'required|string',
            'amenity' => 'required|string',
            'court_type' => 'required|string',
            'additional_info' => 'required|string',
            'address_line1' => 'required|string',
            'address_line2' => 'required|string',
            'city_town' => 'required|string',
            'province' => 'required|string',
            'zip_code' => 'required|numeric',
            'country_code' => 'required|string',
        ];
    }
}
