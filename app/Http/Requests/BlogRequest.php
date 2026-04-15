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
    /**
     * Normalise the is_featured checkbox: browsers omit unchecked checkboxes,
     * so we default to false before validation runs.
     */
    protected function prepareForValidation(): void
    {
        $this->merge([
            'is_featured' => $this->boolean('is_featured'),
        ]);
    }

    public function rules(): array
    {
        $isUpdate = $this->route('blog') !== null;

        return [
            'title'       => ['required', 'string', 'max:255'],
            'slug'        => ['nullable', 'string', 'max:255'],
            'excerpt'     => ['nullable', 'string', 'max:300'],
            'content'     => ['required', 'string'],

            'featured_image' => [
                $isUpdate ? 'nullable' : 'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:2048',
            ],

            'seo_title'       => ['nullable', 'string', 'max:60'],
            'seo_description' => ['nullable', 'string', 'max:160'],
            'seo_keywords'    => ['nullable', 'string', 'max:255'],

            'is_featured'  => ['nullable', 'boolean'],

            'status'       => ['required', 'in:draft,published'],
            'published_at' => ['nullable', 'date'],

            'categories'   => ['nullable', 'array'],
            'categories.*' => ['integer', 'exists:blog_categories,id'],

            'tags' => ['nullable'],
        ];
    }
}
