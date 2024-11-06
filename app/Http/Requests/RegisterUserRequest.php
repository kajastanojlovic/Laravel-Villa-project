<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterUserRequest extends FormRequest
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
            'first_name'=>'required|regex:/^[A-Z][a-z]{2,15}(\s[A-Z][a-z]{2,15})*$/',
            'last_name'=>'required|regex:/^[A-Z][a-z]{2,15}(\s[A-Z][a-z]{2,15})*$/',
            'email'=>'required|email|unique:users,email',
            //unique:table,column,except,idColumn
            //RFC 5322 is an Internet standard that defines the correct format for email messages,
            // including message body, headers, and attachments.
            'address' => 'required|string|regex:/^[A-Za-z0-9\.\-\s\,]*$/',
            'number' => 'required|numeric|min_digits:5',
            'password' => 'required|string|min:7|confirmed',
            'password_confirmation' => 'required|string|min:7'
        ];
    }
}
