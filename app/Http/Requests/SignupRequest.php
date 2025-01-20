<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SignupRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            // 'username' => 'required|string|min:6',             //returning the validations of username field
            // 'email' => 'required|email|unique:users,email',    //returning the validations of email field
            // 'password' => 'required|confirmed|min:8',          //returning the validations of password field
            // 'address' => 'required|string|max:255',            //returning the validations of address field
        ];
    }
}
