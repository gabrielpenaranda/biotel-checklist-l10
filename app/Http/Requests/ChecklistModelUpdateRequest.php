<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ChecklistModelUpdateRequest extends ChecklistModelStoreRequest
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
            'name' => "required|min:10|max:100",
            'description' => "required",
            'instructions' => "required",

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
            'name.unique' => 'El nombre del modelo de checklist ya existe',
            'name.min' => 'El nombre debe tener al menos diez (10) caracteres',
            'name.max' => 'El nombre debe tener máximo de cien (100) caracteres',
            'description.required' => 'La descripción es requerida',
            'instructions.required' => 'Las instrucciones son requeridas',
        ];
    }
}
