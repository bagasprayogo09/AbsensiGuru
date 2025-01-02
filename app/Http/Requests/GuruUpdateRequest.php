<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GuruUpdateRequest extends FormRequest
{
    public function authorize()
    {
        return true; // Adjust according to your authorization logic
    }

    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:gurus,email,' . $this->user()->id,
            // Add other fields and validation rules as necessary
        ];
    }
}
