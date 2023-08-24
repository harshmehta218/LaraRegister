<?php

namespace App\Http\Requests\Booking;

use Illuminate\Foundation\Http\FormRequest;

class Create extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'user_id' => 'required',
            'booking_type' => 'required|in:full_day,half_day',
            'booking_date' => 'required|date_format:Y-m-d',
            'booking_sloat' => 'required|in:morning,evening,fullday',
            'booking_time' => 'required',
        ];
    }
}
