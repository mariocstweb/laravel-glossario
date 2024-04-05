<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateWordRequest extends FormRequest
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
        $id = $this->route('word');

        return [
            'title' => ['required', 'string', Rule::unique('words')->ignore($id)],
            'slug' => 'string',
            'description' => 'string|required',
            'links' => 'nullable|exists:links,id',
            'tags' => 'nullable|array|exists:tags,id',
        ];
    }
    public function messages(): array
    {
        return [
            'title.required' => 'Il campo titolo è obbligatorio',
            'description.required' => 'Il campo decsrizione è obbligatorio',
            'links.exists' => 'Link errato/i',
            'tags.exists' => 'tag errato/i',
        ];
    }
}
