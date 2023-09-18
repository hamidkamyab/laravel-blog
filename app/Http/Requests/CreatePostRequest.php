<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreatePostRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'required|min:8|max:255',
            'body' => 'required|min:8',
            'photo' => 'required',
            'categories' => 'required',
            'status' => 'required',
            'slug' => 'nullable|min:8|max:255|unique:posts'
        ];
    }
}
