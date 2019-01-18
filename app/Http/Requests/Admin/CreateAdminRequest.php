<?php

namespace App\Http\Requests\Admin;

use App\Rules\PasswordRule;
use App\Rules\PhoneRule;
use Illuminate\Foundation\Http\FormRequest;

class CreateAdminRequest extends FormRequest
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
            'email'     => 'required|email|unique:users,email',
            'login'     => 'required|string|unique:users,login',
            'tel'       => ['required','min:10','max:10',new PhoneRule()],
            'city'      => 'required|exists:cities,id',
            'password'  => ['bail','required','string','min:6','max:18','confirmed',new PasswordRule()],
        ];
    }
}
