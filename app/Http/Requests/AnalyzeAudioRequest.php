<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AnalyzeAudioRequest extends FormRequest
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
            'audio' => 'required|file|mimes:mp3,wav|max:10240',
            'text' => 'required|string'
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
            'audio.required' => 'Audio is required',
            'audio.file' => 'Audio must be a file',
            'audio.mimes' => 'Audio must be an mp3 or wav file',
            'audio.max' => 'Audio must be less than 10MB',
            'text.required' => 'Text is required',
            'text.string' => 'Text must be a string'
        ];
    }
}
