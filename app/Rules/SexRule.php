<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class SexRule implements Rule
{

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        return ($value == 'homme' || $value == 'femme');
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return __('validation.regex',[__('validation.attributes.sex')]);
    }
}
