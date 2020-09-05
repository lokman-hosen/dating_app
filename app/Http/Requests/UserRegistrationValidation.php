<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRegistrationValidation extends FormRequest
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
            'name' => 'required',
            'email' => 'required',
            'gender' => 'required|numeric',
            'birth_date' => 'required|date',
            //'location_latitude' => 'required',
            'location_longitude' => 'required',
            'password' => 'required|confirmed',
            'password_confirmation' => 'required',
        ];
    }
}
