<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use SebastianBergmann\Type\TrueType;

class AdminProfileUpdateRequest extends FormRequest
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
            'name' => ['required', 'string'],
            'email' => ['required', 'email'],
            'oldPassword' => ['nullable', 'min:8'],
            'newPassword' => ['nullable', 'min:8']
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'The admin name is required.',
            'email.unique'  => 'This email is already taken.',
        ];
    }
}
