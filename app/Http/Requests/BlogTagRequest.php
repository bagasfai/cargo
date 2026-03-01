<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BlogTagRequest extends FormRequest
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
        $blogTag = $this->route('blogTag');
        
        return [
            'name' => ['required', 'string', 'max:255', 'unique:blog_tags,name,' . ($blogTag->id ?? 'NULL')],
            'slug' => ['nullable', 'string', 'max:255', 'unique:blog_tags,slug,' . ($blogTag->id ?? 'NULL')],
        ];
    }
}
