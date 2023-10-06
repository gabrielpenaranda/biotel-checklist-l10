<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ChecklistModelCloneRequest extends FormRequest
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
            'new_name' => "required|unique:checklist_models,name|min:10|max:100",
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
            'new_name.required' => 'El nombre del modelo clonado es requerido',
            'new_name.unique' => 'El nombre del modelo de checklist clonado ya existe',
            'new_name.min' => 'El nombre debe tener al menos diez (10) caracteres',
            'new_name.max' => 'El nombre debe tener máximo de cien (100) caracteres',
        ];
    }
}
