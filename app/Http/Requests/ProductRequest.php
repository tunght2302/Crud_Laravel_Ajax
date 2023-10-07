<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => 'required | regex:/^[\pL\pM\s]+$/u | min:2 | max:255',
            'price' => 'required | numeric',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ];
    }
}
