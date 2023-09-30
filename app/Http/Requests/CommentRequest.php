<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        if(Auth::check()){
            $rules = [
                'body' => 'required|min:6|max:1500',
            ];
        }else{
            $rules = [
                'name' => 'required|min:3|max:255',
                'email' => 'required|email|max:255',
                'body' => 'required|min:6|max:1500',
            ];
        }


        return $rules;
    }
}
