<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

use App\Rules\PasswordConfirmationRule;

use Illuminate\Http\Request;

class UserPasswordUpdateRequest extends FormRequest
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
    public function rules(Request $request)
    {
        $password = $request->get('password');
        $password_confirmation = $request->get('password-confirmation');

        return [
            'password' => "required|min:8|max:20",
            'password-confirmation' => ["required","min:8", "max:20", new PasswordConfirmationRule($password,$password_confirmation)],

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
            'password.min' => 'El password debe tener al menos ocho (8) caracteres',
            'password.max' => 'El password debe tener máximo de veinte (20) caracteres',
            'password.required' => 'El password es requerido',
            'password-confirmation.min' => 'La confirmación del password debe tener al menos ocho (8) caracteres',
            'password-confirmation.max' => 'La confirmación del password debe tener máximo de veinte (20) caracteres',
            'password-confirmation.required' => 'La confirmación del password es requerida',
        ];
    }
}
