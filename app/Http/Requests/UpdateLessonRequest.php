<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateLessonRequest extends FormRequest
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
            'title' => 'required|string|max:255',
            'description' => 'string|nullable|max:255',
            'grammar_topic' => 'required|string|max:255', 
            'objective' => 'string|nullable|max:255', 
            'vocabulary' => 'array|nullable',
            'verbs' => 'array|nullable',
            'native_expression' => 'array|nullable',
            'content' => 'array|nullable',
            'module_id' => 'required|integer',
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
            'title.required' => 'El título es requerido',
            'title.string' => 'El título debe ser una cadena de texto',
            'description.string' => 'La descripción debe ser una cadena de texto',
            'description.max' => 'La descripción no debe exceder los 255 caracteres',
            'grammar_topic.required' => 'La gramática es requerida',
            'grammar_topic.string' => 'La gramática debe ser una cadena de texto',
            'grammar_topic.max' => 'La gramática no debe exceder los 255 caracteres',
            'objective.string' => 'El objetivo debe ser una cadena de texto',
            'objective.max' => 'El objetivo no debe exceder los 255 caracteres',
            'vocabulary.array' => 'El vocabulario debe ser un arreglo',
            'verbs.array' => 'Los verbos deben ser un arreglo',
            'native_expression.array' => 'Las expresiones nativas deben ser un arreglo',
            'content.array' => 'El contenido debe ser un arreglo',
            'module_id.required' => 'El id del módulo es requerido',
            'module_id.integer' => 'El id del módulo debe ser un número entero',
        ];
    }
}
