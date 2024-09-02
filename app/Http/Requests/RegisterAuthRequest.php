<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterAuthRequest extends FormRequest
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
            'name' => 'required|string',
            'email' => 'required|email|unique:users',
            'password' => 'required',
            'password_confirmation' => 'required|same:password',
            'reason' => 'required|string',
            'time_commitment' => 'required|string',
            'current_level' => 'required|string',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'name.required' => 'Name is required',
            'name.string' => 'Name must be a string',
            'email.required' => 'Email is required',
            'email.email' => 'Email is invalid',
            'email.unique' => 'Email is already taken',
            'password.required' => 'Password is required',
            'password_confirmation.required' => 'Confirm Password is required',
            'password_confirmation.same' => 'Password does not match',
            'reason.required' => 'Reason is required',
            'reason.string' => 'Reason must be a string',
            'time_commitment.required' => 'Time commitment is required',
            'time_commitment.string' => 'Time commitment must be a string',
            'current_level.required' => 'Current level is required',
            'current_level.string' => 'Current level must be a string',
        ];
    }
}
