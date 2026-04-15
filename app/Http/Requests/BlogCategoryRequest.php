<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BlogCategoryRequest extends FormRequest
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
        $blogCategory = $this->route('blogCategory');
        
        return [
            'name' => ['required', 'string', 'max:255', 'unique:blog_categories,name,' . ($blogCategory->id ?? 'NULL')],
            'slug' => ['nullable', 'string', 'max:255', 'unique:blog_categories,slug,' . ($blogCategory->id ?? 'NULL')],
            'description' => ['nullable', 'string'],
        ];
    }
}
