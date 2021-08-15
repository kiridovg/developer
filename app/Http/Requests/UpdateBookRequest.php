<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules;

class UpdateBookRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'required|max:255',
            'description' => 'required',
            'image' => 'required|mimes:jpeg,jpg,png|dimensions:max_width=2000,max_height=2000|max:2048',
            'category' => 'required',
            'author' => 'required',
            'category.required' => 'Please select a category.',
            'author.required' => 'Please select a author.'
        ];
    }
}
