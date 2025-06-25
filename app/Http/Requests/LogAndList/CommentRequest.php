<?php

namespace App\Http\Requests\LogAndList;

use Illuminate\Foundation\Http\FormRequest;

class CommentRequest extends FormRequest
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
            'nickname' => 'required|string',
            'password_hash' => 'required|string',
            'content' => 'required|string',
            'page_id' => 'required|string',
            'parent_id' => 'nullable|integer',
        ];
    }

    public function messages(): array
    {
        return [
            'nickname.required' => 'The nickname is a required field.',
            'password_hash.required' => 'The password hash is a required field.',
            'content.required' => 'The content is a required field.',
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
