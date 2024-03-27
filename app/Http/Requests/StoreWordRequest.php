<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;


class StoreWordRequest extends FormRequest
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
            'title' => 'required|string|unique:words',
            'slug' => 'string',
            'description' => 'string|required',
            'links' => 'nullable|exists:links,id',
        ];
    }
    public function messages(): array
    {
        return [
            'title.required' => 'Il campo titolo è obbligatorio',
            'description.required' => 'Il campo decsrizione è obbligatorio',
            'links.exists' => 'Link errato/i',
        ];
    }
}
