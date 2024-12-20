<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateStudentRequest extends FormRequest
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
            'name' => 'required|max:255|min:5|regex:/^[A-Z-А-Я][A-Za-zА-Яа-я\s\.\-\',\(\)]+ [A-Z-А-Я]\.([A-Z-А-Я]\.)?$/u',
            'email' => 'required|email',
            'phone_number' => 'required|min:11|max:11|starts_with:8'
        ];
    }
}
