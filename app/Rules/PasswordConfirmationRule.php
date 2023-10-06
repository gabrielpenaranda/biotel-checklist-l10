<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class PasswordConfirmationRule implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($password, $password_confirmation)
    {
        $this->password = $password;
        $this->password_confirmation = $password_confirmation;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        if ($this->password === $this->password_confirmation) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Los password no son iguales';
    }
}
