<?php

namespace App\Http\Requests\LogAndList;

use Illuminate\Foundation\Http\FormRequest;

class PathNoteRequest extends FormRequest
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
            'title' => 'required|string',
            'content_ko' => 'required|string',
            'content_ja' => 'required|string',
        ];
    }

    public function messages(): array
    {
        return [
            'title.required' => 'The title is a required field.',
            'content_ko.required' => 'The Context (Korean) is a required field.',
            'content_ja.required' => 'The Context (Japanese) is a required field.',
        ];
    }

    public function attributes(): array
    {
        return [
            'title' => 'Title',
            'content_ko' => 'Content(Korean)',
            'content_ja' => 'Content(Japanese)',
        ];
    }
}
