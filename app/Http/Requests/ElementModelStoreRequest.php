<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ElementModelStoreRequest extends FormRequest
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
            'description' => "required|min:5|max:250",
            'element_number' => "required",

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
            'description.min' => 'El nombre debe tener al menos cinco (5) caracteres',
            'description.max' => 'El nombre debe tener máximo de doscientos cincuenta (250) caracteres',
            'description.required' => 'La descripción es requerida',
            'element_number.required' => 'El número de elemento es requerido',
        ];
    }
}
