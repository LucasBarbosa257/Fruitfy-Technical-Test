<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ContactRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|min:3|max:60',
            'email' => [
                'required',
                'email',
                'max:100',
                Rule::unique('contacts', 'email')->ignore($this->route('id')),
            ],
            'phone' => 'required|string|min:10|max:20',
        ];
    }
}
