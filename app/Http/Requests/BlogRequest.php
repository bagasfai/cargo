<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BlogRequest extends FormRequest
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
            'title' => ['required', 'max:255'],
            'slug' => ['nullable', 'max:255'],
            'excerpt' => ['nullable', 'max:300'],
            'content' => ['required'],

            'seo_title' => ['nullable', 'max:60'],
            'seo_description' => ['nullable', 'max:160'],
            'seo_keywords' => ['nullable', 'max:255'],

            'status' => ['required', 'in:draft,published'],
            'published_at' => ['nullable', 'date'],

            'author_id' => ['nullable', 'exists:users,id'],

            'categories' => ['nullable', 'array'],
            'categories.*' => ['integer', 'exists:blog_categories,id'],

            'tags' => ['nullable'],
        ];
    }
}
