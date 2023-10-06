<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

use App\Rules\PasswordConfirmationRule;

use Illuminate\Http\Request;

class UserStoreRequest extends FormRequest
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
            'name' => "required|min:5|max:100",
            'email' => "email|required|unique:users,email|min:10|max:150",
            'identification' => "required|unique:users,email|min:5,max:20",
            'position' => "required|min:5|max:100",
            'password' => "required|min:8|max:20",
            'password-confirmation' => ["required", "min:8", "max:20", new PasswordConfirmationRule($password, $password_confirmation)],
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
            'email.email' => 'El formato de email no es válido',
            'email.required' => 'El email es requerido',
            'email.unique' => 'El email ya está siendo utilizado',
            'email.min' => 'El email debe tener al menos diez (10) caracteres',
            'email.max' => 'El email debe tener máximo de ciento cincuenta (150) caracteres',
            'identification.required' => 'La cédula e identidad es requerida',
            'identification.unique' => 'La cédula e identidad ya está registrada',
            'identification.min' => 'La cédula e identidad debe tener al menos cinco (5) caracteres',
            'identification.max' => 'La cédula e identidad debe tener máximo de diez (10) caracteres',
            'position.required' => 'El cargo es requerido',
            'position.min' => 'El cargo debe tener al menos cinco (5) caracteres',
            'position.max' => 'El cargo debe tener máximo de cien (100) caracteres',
            'password.min' => 'El password debe tener al menos ocho (8) caracteres',
            'password.max' => 'El password debe tener máximo de veinte (20) caracteres',
            'password.required' => 'El password es requerido',
            'password-confirmation.min' => 'La confirmación del password debe tener al menos ocho (8) caracteres',
            'password-confirmation.max' => 'La confirmación del password debe tener máximo de veinte (20) caracteres',
            'password-confirmation.required' => 'La confirmación del password es requerida',
        ];
    }
}
