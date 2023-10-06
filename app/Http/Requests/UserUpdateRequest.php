<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if (auth()->user()) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {

        return [
            'name' => "required|min:5|max:100",
            'position' => "required|min:5|max:100",
        ];
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'name.required' => 'El nombre es requerido',
            'name.min' => 'El nombre debe tener al menos cinco (5) caracteres',
            'name.max' => 'El nombre debe tener máximo de cien (100) caracteres',
            'position.required' => 'El cargo es requerido',
            'position.min' => 'El cargo debe tener al menos cinco (5) caracteres',
            'position.max' => 'El cargo debe tener máximo de cien (100) caracteres',
        ];
    }
}
